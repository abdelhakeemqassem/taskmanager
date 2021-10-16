<template>
    <div class="row">
          <div class="col-12">
               <div class="card">
              <div class="card-header">
                <h3 class="card-title">My Tasks</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>Description</th>
                      <th>Start Date</th>
                      <th>Duration</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-if='task'  v-for="task in tasks" :key="task.id">
                      <td>{{task.name}}</td>
                      <td>{{task.description}}</td>
                      <td>{{task.start_date}}</td>
                      <td>{{task.duration}} Days</td>
                     </tr>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
        </div>

</template>

<script>

import axios from 'axios'
 
export default {
 
  data: () => ({
      tasks:[],
  }),

  methods: {
 
    loadtasks(){
        axios.get('/employee/tasks/show').then( ( {data} )=>(this.tasks=data) );
      },
  },
  created() {
      this.loadtasks();
       },
  mounted() {
  },
}
</script>
