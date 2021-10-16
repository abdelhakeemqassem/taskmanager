<template>
    <div class="row">
          <div class="col-12">
               <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tasks</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button style="margin-bottom:10px" class="btn btn-success" @click="newModal" >Add Task</button>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Task</th>
                      <th>Description</th>
                      <th>Start Date</th>
                      <th>Duration</th>
                      <th>Task Type</th>
                      <th>Employees Assigned</th>
                      <th>action</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="task in tasks" :key="task.id">
                      <td>{{task.name}}</td>
                      <td>{{task.description}}</td>
                      <td>{{task.start_date}}</td>
                      <td>{{task.duration}} Days</td>
                      <td>{{task.role_name}}</td>
                      <td>{{task.employee}}</td>
                      <td>
                          <a href="#" @click="editModal(task)">Edit<i class="text-success fa fa-edit" aria-hidden="true"></i></a>
                          <a href="#" @click="deletetask(task.id)">Delete<i class="text-red fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  
                  </tbody>
                </table>
              </div>

            </div>
            </div>
                  
        <!--Add Modal -->
        <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addnewLabel" v-show="!editmode">Add New Task</h5>
                    <h5 class="modal-title" id="addnewLabel" v-show="editmode">Update Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="editmode ? update() :create()" @keydown="form.onKeydown($event)">
                        <AlertErrors :form="form" />
                        <AlertSuccess :form="form" message="Task Added Successfully" />
                        <div v-show="task" class="alert alert-success assign-success">
                         And Assisgned: <span class="text text-red">{{( task )}} </span> To The Task
                          </div>
                       

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" v-model="form.name" type="text" name="name" class="form-control">
                            <HasError :form="form" field="name" />
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input id="description" v-model="form.description" type="text-area" name="description" class="form-control">
                            <HasError :form="form" field="description" />
                        </div>
                         
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Due Date</label>
                            <datepicker id="start_date" v-model="form.start_date" name="start_date" ></datepicker>
                            <HasError :form="form" field="start_date" />
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (In Days)</label>
                            <input id="duration" v-model="form.duration" type="text" name="duration" class="form-control">
                            <HasError :form="form" field="duration" />
                        </div>
                        
                       <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-control" name="role" v-model="form.role" >
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                            <HasError :form="form" field="role" />
                          </select>
                        </div> 

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <Button :form="form" :disabled="form.busy" class="btn btn-success">Save</Button>   
                        </div>          
                    </form>

                </div>
            
            </div>
        </div>
        </div>

        
        </div>

</template>

<script>
import Datepicker from 'vuejs-datepicker'

import Form from 'vform'
import { Button, HasError, AlertError, AlertErrors,AlertSuccess } from 'vform/src/components/bootstrap5'
import axios from 'axios'
 
 
export default {
  components: {
    Button, HasError, AlertError, AlertErrors,AlertSuccess,Datepicker
  },
  
  data: () => ({
      tasks:[],
      roles:[],
      task:undefined,
      editmode: true,
      form: new Form({
        id:'',
        name: '',
        description: '',
        start_date: '',
        duration: '',
        role: '',
    })
  }),

  methods: {
 
    loadtasks(){
        axios.get('/admin/tasks/show').then( ( {data} )=>(this.tasks=data) );
      },
    loadroles(){
        axios.get('/admin/roles').then( ( {data} )=>(this.roles=data.data) );
     },
      assigntask($id){
        axios.get('/admin/assigntask/'+$id).then( ( {data} )=>(this.task=data) );
      },
    editModal(user){
      this.editmode = true;
      this.form.clear();
      this.form.reset();
      $('#addnew').modal('show');
       this.form.fill(user);
      },
    newModal(){
     this.editmode = false;
     this.form.clear();
     this.form.reset();
     $('#addnew').modal('show');
     },
    async create() {
        const response = await this.form.post('/admin/task/create');
        this.assigntask(response.data.id);
        this.form.reset();
        Fire.$emit('AfterCreate');
    },
      update(){
      this.form.put('/admin/task/update/'+this.form.id)
      .then(() => {
          // success
          $('#addnew').modal('hide');
          Fire.$emit('AfterCreate');
      })
     
     },
    async deletetask(id) {
        await axios.delete(`/admin/task/delete/${id}`);
       Fire.$emit('AfterCreate');

    },
  
   
 
       
  },
  created() {
      this.loadtasks();
      this.loadroles();
      Fire.$on('AfterCreate',() =>{
          this.loadtasks();
          
      });

  },
  mounted() {
    console.log('tasks')
  },
}
</script>
