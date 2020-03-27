new Vue({
    el: "#todo",
    data() {
        return {
            task_list: [],
            total_task: 0,
            TodoForm: {
                task_name: ''
            },
            EditTodoForm: {
                id: '',
                task_name: ''
            },
            complete_index: '',
            is_clear_completed: false,
            edit_index: null,
        }
    },
    methods: {

        NewTodo: function (event) {
            const _this = this;
            _this.is_clear_completed = false;
            var formdata = new FormData();
            formdata.append('task_name', _this.TodoForm.task_name);
            axios.post("route.php?page=new_todo", formdata)
                .then((response) => {
                    _this.GetActiveTodo();
                    _this.TodoForm.task_name = '';
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        EditTodo: function (data, index) {
            const _this = this;
            _this.is_clear_completed = false;
            _this.EditTodoForm.id = data.id;
            _this.EditTodoForm.task_name = data.task_name;
            _this.edit_index = index;

        },
        UpdateTodo: function (event) {
            const _this = this;
            _this.is_clear_completed = false;
            var formdata = new FormData();
            formdata.append('id', _this.EditTodoForm.id);
            formdata.append('task_name', _this.EditTodoForm.task_name);
            axios.post("route.php?page=edit_todo", formdata)
                .then((response) => {
                    //console.log(response);
                    _this.GetActiveTodo();
                    _this.EditTodoForm.id = '';
                    _this.EditTodoForm.task_name = '';
                    _this.edit_index = null;
                })
                .catch((error) => {
                    console.log(error)
                })
        },
        GetActiveTodo: function () {
            const _this = this;
            _this.total_task = 0;
            _this.is_clear_completed = false;
            axios.get("route.php?page=get_active")
                .then((response) => {
                    _this.task_list = response.data;
                    _this.total_task = response.data.length;
                    console.log(_this.task_list);
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        GetAllTodo: function () {
            const _this = this;
            _this.total_task = 0;
            _this.is_clear_completed = false;
            axios.get("route.php?page=get_all")
                .then((response) => {
                    _this.task_list = response.data;
                    _this.total_task = response.data.length;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        GetCompletedTodo: function () {
            const _this = this;
            _this.total_task = 0;
            _this.is_clear_completed = true;
            axios.get("route.php?page=get_completed")
                .then((response) => {
                    _this.task_list = response.data;
                    _this.total_task = response.data.length;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        Complete: function (task_id, index) {
            const _this = this;
            _this.complete_index = index;
            _this.total_task -= 1;
            _this.is_clear_completed = false;
            axios.get("route.php?page=complete&task_id=" + task_id)
                .then((response) => {
                    console.log(response);
                    _this.task_list[index].task_status = 2;
                })
                .catch((error) => {
                    console.log(error);
                })
        },
        ClearCompletedTodo: function () {
            const _this = this;
            _this.is_clear_completed = false;
            axios.post("route.php?page=clear_complete")
                .then((response) => {
                    _this.task_list = [];
                    _this.total_task = 0;
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    },
    created() {
        this.GetActiveTodo();
        console.log("created");
    }
});