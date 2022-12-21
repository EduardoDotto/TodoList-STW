<template>
    <div>
      <div class="name-container">
        Welcome, {{ name }}
      </div>
      <input type="text" class="todo-input" placeholder="O que precisa ser feito" v-model="newTodo" @keyup.enter="addTodo">
        <div v-if="$store.state.loading" class="lds-default">
          <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
        </div>
      <transition-group name="fade" enter-active-class="animated fadeInUp" leave-active-class="animated fadeOutDown">
      <todo-item v-for="todo in todosFiltered" :key="todo.id" :todo="todo" :checkAll="!anyRemaining">
      </todo-item>
      </transition-group>

      <div class="extra-container">
        <todo-check-all></todo-check-all>
        <todo-items-remaining></todo-items-remaining>
      </div>

      <div class="extra-container">
        <todo-filtered></todo-filtered>

        <div>
          <transition name="fade">
          <todo-clear-completed></todo-clear-completed>
          </transition>
        </div>

      </div>
    </div>
  </template>

  <script>
  import TodoItem from './TodoItem'
  import TodoItemsRemaining from './TodoItemsRemaining'
  import TodoCheckAll from './TodoCheckAll'
  import TodoFiltered from './TodoFiltered'
  import TodoClearCompleted from './TodoClearCompleted'


  export default {
    name: 'todo-list',
    components: {
      TodoItem,
      TodoItemsRemaining,
      TodoCheckAll,
      TodoFiltered,
      TodoClearCompleted,
    },
    data () {
      return {
        newTodo: '',
        idForTodo: 3,
        name: '',
      }
    },
    created(){
      this.$store.dispatch('retrieveTodos')
      this.$store.dispatch('retrieveName')
        .then(response=>{
          this.name = response.data.name
        })

    },
    computed: {
      anyRemaining() {
        return this.$store.getters.anyRemaining
      },
      todosFiltered() {
        return this.$store.getters.todosFiltered
      }
    },
    methods: {
      addTodo() {
        if (this.newTodo.trim().length == 0) {
          return
        }

        this.$store.dispatch('addTodo', {
          id: this.idForTodo,
          title: this.newTodo,
        })

        this.newTodo = ''
        this.idForTodo++
      },
    }
  }
  </script>

  <style>
  

  .todo-input {
      width: 100%;
      padding: 10px 18px;
      font-size: 18px;
      margin-bottom: 16px;

  }

  .todo-item {
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      animation-duration: .3s;
  }

  .remove-item {
      cursor: pointer;
      margin-left: 14px;

  }

  .remove-item:hover {
          color: rgb(255, 0, 0);
  }

  .todo-item-left {
      display: flex;
      align-items: center;
  }

  .todo-item-label {
      padding: 10px;
      border: 1px solid white;
      margin-left: 12px;
  }

  .todo-item-edit {
      font-size: 24px;
      color: #2c3e50;
      margin-left: 12px;
      width: 100%;
      padding: 10px;
      border: 1px solid #ccd;
      font-family: 'Avenir', Helvetica, Arial, sans-serif;
  }

  .todo-item-edit:focus {
      outline: none;
  }

  .completed {
      text-decoration: line-through;
      color: grey;
  }

  .extra-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 16px;
      border-top: 1px solid lightgrey;
      padding-top: 14px;
      margin-bottom: 14px;
  }

  .name-container {
    margin-bottom: 16px;
  }

  button {
      font-size: 14px;
      background-color: white;
      appearance: none;
      padding: 4px;
  }

  button:hover {
      background: rgb(65,184,131);
  }

  button:focus {
      outline: none;
  }

  .active {
      background: rgb(65,184,131);
  }

  .fade-enter-active, .fade-leave-active {
      transition: .2s;
  }

  .fade-enter, .fade-leave-to {
      opacity: 0;
  }


 /* Css - LOADING*/
 .lds-default {
  display: block;
  position: relative;
  width: 80px;
  height: 80px;
  margin: auto;
  margin-bottom: 10px;
}
.lds-default div {
  position: absolute;
  width: 6px;
  height: 6px;
  background: rgb(65,184,131);
  border-radius: 50%;
  animation: lds-default 0.5s linear infinite;
}
.lds-default div:nth-child(1) {
  animation-delay: 0s;
  top: 37px;
  left: 66px;
}
.lds-default div:nth-child(2) {
  animation-delay: -0.1s;
  top: 22px;
  left: 62px;
}
.lds-default div:nth-child(3) {
  animation-delay: -0.2s;
  top: 11px;
  left: 52px;
}
.lds-default div:nth-child(4) {
  animation-delay: -0.3s;
  top: 7px;
  left: 37px;
}
.lds-default div:nth-child(5) {
  animation-delay: -0.4s;
  top: 11px;
  left: 22px;
}
.lds-default div:nth-child(6) {
  animation-delay: -0.5s;
  top: 22px;
  left: 11px;
}
.lds-default div:nth-child(7) {
  animation-delay: -0.6s;
  top: 37px;
  left: 7px;
}
.lds-default div:nth-child(8) {
  animation-delay: -0.7s;
  top: 52px;
  left: 11px;
}
.lds-default div:nth-child(9) {
  animation-delay: -0.8s;
  top: 62px;
  left: 22px;
}
.lds-default div:nth-child(10) {
  animation-delay: -0.9s;
  top: 66px;
  left: 37px;
}
.lds-default div:nth-child(11) {
  animation-delay: -1s;
  top: 62px;
  left: 52px;
}
.lds-default div:nth-child(12) {
  animation-delay: -1.1s;
  top: 52px;
  left: 62px;
}
@keyframes lds-default {
  0%, 20%, 80%, 100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.5);
  }
}


</style>
