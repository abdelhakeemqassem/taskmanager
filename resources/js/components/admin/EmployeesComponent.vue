<template>
    <div class="row">
          <div class="col-12">
               <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employees</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <button style="margin-bottom:10px" class="btn btn-success" @click="newModal" >Add Employee</button>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Team Role</th>
                       <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="employee in employees" :key="employee.id">
                      <td>{{employee.name}}</td>
                      <td>{{employee.email}}</td>
                      <td>{{employee.role_name}}</td>
                      <td>
                          <a href="#" @click="editModal(employee)">Edit<i class="text-success fa fa-edit" aria-hidden="true"></i></a>
                          <a href="#" @click="deleteemployee(employee.id)">Delete<i class="text-red fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div> -->
            </div>
            </div>
                  
        <!-- Modal -->
        <div class="modal fade" id="addnew" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="addnewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                     <h5 class="modal-title" id="addnewLabel" v-show="!editmode">Add New Employee</h5>
                    <h5 class="modal-title" id="addnewLabel" v-show="editmode">Update Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="editmode ? update() :create()" @keydown="form.onKeydown($event)">
                        <AlertErrors :form="form" />
                        <AlertSuccess :form="form" message="Added Successfully" />

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" v-model="form.name" type="text" name="name" class="form-control">
                            <HasError :form="form" field="name" />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">email</label>
                            <input id="email" v-model="form.email" type="text-area" name="email" class="form-control">
                            <HasError :form="form" field="email" />
                        </div>
                         
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" v-model="form.password" name="password" >
                            <HasError :form="form" field="password" />
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input class="form-control" type="password" id="password" v-model="form.password_confirmation" name="password_confirmation" >
                            <HasError :form="form" field="password_confirmation" />
                        </div>

                        <div class="mb-3">
                            <label for="Team_role" class="form-label">Job Position</label>
                            <select class="form-control" name="team_role" v-model="form.team_role" >
                            <option v-for="role in roles" :key="role.id" :value="role.id">{{role.name}}</option>
                            <HasError :form="form" field="team_role" />
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
      employees:[],
      roles:[],
      editmode: true,
      form: new Form({
      id:'',
      name: '',
      email: '',
      password: '',
      team_role: '',
    })
  }),

  methods: {
 
    loademployees(){
        axios.get('employees/show').then( ( {data} )=>(this.employees=data.data) );
      },
   loadroles(){
        axios.get('roles').then( ( {data} )=>(this.roles=data.data) );
     },
    async create() {
        const response = await this.form.post('employee/create');
        this.form.reset();
        Fire.$emit('AfterCreate');
    },
   async deleteemployee(id) {
        await axios.delete(`employee/delete/${id}`);
       Fire.$emit('AfterCreate');

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
      update(){
      this.form.put('/admin/employee/update/'+this.form.id)
      .then(() => {
          // success
          $('#addnew').modal('hide');
          Fire.$emit('AfterCreate');
      })
     
     },
  },
  created() {
      this.loademployees();
      this.loadroles();
      Fire.$on('AfterCreate',() =>{
          this.loademployees();
      });

  },
   mounted() {
    console.log('employees')
  },
}
</script>
