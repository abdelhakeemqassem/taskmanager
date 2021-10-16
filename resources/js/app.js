require('./bootstrap');
window.Vue = require('vue').default;

//Fire to load the page changes 
window.Fire =new Vue();


import TasksComponent from './components/admin/TasksComponent';
import EmployeesComponent from './components/admin/EmployeesComponent';
import EmployeeTasks from './components/employee/MyTasksComponent';
var app = new Vue({
    el: '#app',
    components: { 
      tasks: TasksComponent,
      employees: EmployeesComponent,
      employeetasks:EmployeeTasks
     }
});

