<!DOCTYPE HTML>
<html>

<head>
  <title>Todo</title>
  <link rel="stylesheet" src="assets/style.css" />
  <link rel=" stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
</head>

<body class="bg-light">
  <div id="todo">
    <div class="container-fluid">
      <h1 style="font-size: 90px; color: #ff000030;" class="text-center">todos</h1>
      <div class="row">
        <div class="col-lg-4 col-md-4"></div>
        <div class="col-lg-4 col-md-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">
                <form @submit.prevent="NewTodo($event)">
                  <input class="form-control" v-model="TodoForm.task_name" placeholder="What Needs to be done?" />
                </form>
              </h5>

              <div class="row" v-for="(task_data,index) in task_list" :key="index">
                <div class="col-lg-2">
                  <h3>
                    <i @click="Complete(task_data.id,index)" :class="{ 'fa fa-check-circle-o': task_data.task_status == 2 ,'fa fa-circle-thin': task_data.task_status == 1 }" aria-hidden="true"></i>
                  </h3>
                  <hr>
                </div>
                <div class="col-lg-8">
                  <h3 @dblclick="EditTodo(task_data,index)" v-show="edit_index != index " :style="task_data.task_status == 2 ? 'text-decoration:line-through' : '' ">
                    {{task_data.task_name}}
                  </h3>
                  <form @submit.prevent="UpdateTodo($event)">
                    <input v-show="edit_index == index " :value="task_data.task_name" v-model="EditTodoForm.task_name" ref="edit" class="form-control">
                  </form>
                  <hr>
                </div>


              </div>



              <span class="btn btn-info btn-sm">{{total_task}} items Left</span>
              <button class="btn btn-info" @click="GetAllTodo">All</button>
              <button class="btn btn-warning" @click="GetActiveTodo">Active</button>
              <button class="btn btn-success" @click="GetCompletedTodo">Completed</button>
              <button v-show="is_clear_completed" class="btn btn-danger" @click="ClearCompletedTodo">Clear Completed</button>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4"></div>

      </div>
    </div>
  </div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
<script src="https://use.fontawesome.com/d05ae2b062.js"></script>
<script type="text/javascript" src="assets/todo.js"></script>

</html>