<template>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        My PhoneBook
                    </div>

                    <div class="card-body" id="parent-reload">
                        <table class="table" id="reload">
                            
                            <tbody>
                                <tr v-for="(value, index) in list_of_data">
                                    <td style="width: 10px;"><img src="img/user_icon.png" style="width: 30px;"/></td>
                                    <td>
                                        <span style="display: block;">
                                            {{ value.phone_number }}
                                        </span>

                                        <span style="display: block;">
                                            {{ value.fname + " " + value.mname + " " + value.lname }}
                                        </span>
                                    </td>
                                    
                                    <td style="width: 150px; display: flex;">
                                            <button class="edit" @click="edits(value)" style="margin-right: 5px;" type="submit">
                                                <i class="bi bi-pencil-square"></i>
                                                <span>Edit</span>
                                            </button>

                                            <button class="delete" @click="butones(value, index)" type="submit">
                                                <i class="bi bi-trash"></i>
                                                <span>Delete</span>
                                            </button>
                                    </td>


                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <div class="col-4">
                <div class="card" style="position: relative;">
                    <div class="card-header">
                        Add Contacts
                    </div>

                    <div class="card-body">
                        <Form @submit="Submit">
                            <div class="row">
                                <div class="col-2">
                                    <i class="bi bi-telephone-fill"></i>
                                </div>

                                <div class="col-10">
                                    <div style="display: flex;">
                                        <label style="background-color: white; padding: 5px;">+63</label>
                                        <Field class="input_number" v-model="form.phone_number" name="phone_number" placeholder="Phone" maxlength="10" :rules="validatePhone"  style="display: block; border-bottom: 1px solid; border: none; outline: none; width: 100%;"/>
                                    </div>
                                    <ErrorMessage id="error_mess" name="phone_number"/>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-2">
                                    <i class="bi bi-person" style="font-size: 25px;"></i>
                                </div>

                                <div class="col-10">

                                        <Field class="input" v-model="form.fname" name="fname" placeholder="First Name" :rules="validateName"/> 
                                        <ErrorMessage id="error_mess" name="fname"/>

                                        <Field class="input" v-model="form.lname" name="lname" placeholder="Last Name" :rules="validateName"/> 
                                        <ErrorMessage id="error_mess" name="lname"/>

                                        <Field class="input" v-model="form.mname" name="mname" placeholder="Middle Name" :rules="validateName"/> 
                                        <ErrorMessage id="error_mess" name="mname"/>

                                </div>
                            </div>

                            <div class="save-btn-parent">
                                <button class="save-btn" type="submit">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </Form>
                    </div>

                </div>
            </div>

        </div>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Contact</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                    <div class="modal-body" style="width: 100%; display: flex; justify-content: center; align-items: center;">
                                        <Form @submit="Save" style="width: 90%;">

                                            <Field v-model="id" name="ID" placeholder="ID" style="display: none;"/>


                                            <div class="row">
                                                <div class="col-2">
                                                    <i class="bi bi-telephone-fill"></i>
                                                </div>

                                                <div class="col-10">
                                                    <div style="display: flex;">
                                                        <label style="background-color: white; padding: 5px;">+63</label>
                                                        <Field class="input_number" v-model="edit.phone_number" name="edit_phone_number" placeholder="num" :rules="validatePhone" maxlength="10"/>
                                                    </div>
                                                    <ErrorMessage id="error_mess" class="form-required" name="edit_phone_number"/>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-2">
                                                    <i class="bi bi-person" style="font-size: 25px;"></i>
                                                </div>

                                                <div class="col-10">

                                                    <Field class="input" v-model="edit.fname" name="edit_fname" placeholder="string" :rules="validateName"/>
                                                    <ErrorMessage id="error_mess" class="form-required" name="edit_fname"/>

                                                    <Field class="input" v-model="edit.lname" name="edit_lname" placeholder="string" :rules="validateName"/>
                                                    <ErrorMessage id="error_mess" class="form-required" name="edit_lname"/>

                                                    <Field class="input" v-model="edit.mname" name="edit_mname" placeholder="string" :rules="validateName"/>
                                                    <ErrorMessage id="error_mess" class="form-required" name="edit_mname"/>

                                                </div>
                                            </div>

                                            <!-- <Field v-model="edit.gender" name="edit_gender" placeholder="mix" style="display: block;"/> -->



                                            <div class="modal-footer">
                                                <button id="sample-buttons" class="btn btn-primary" type="submit">UPDATE</button>
                                            </div>

                                        </Form>
                                    </div>

                            </div>
                        </div>
                    </div>


                    <div id="toast-success" class="toast mt-3" style="position: absolute; right: 15px; bottom: 15px;">
                        <div class="toast-header">
                            <i class="bi bi-check-circle-fill" style="margin-right: 3px; color: green;"></i>
                            Success
                        </div>
                        <div class="toast-body">
                            Contact has been created
                        </div>
                    </div>

                    <div id="toast-delete" class="toast mt-3" style="position: absolute; right: 15px; bottom: 15px;">
                        <div class="toast-header">
                            <i class="bi bi-check-circle-fill" style="margin-right: 3px; color: green;"></i>
                            Deleted
                        </div>
                        <div class="toast-body">
                            Contact has been deleted
                        </div>
                    </div>
                    


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                </div>
                                <div class="modal-body">
                                    Delete Contact?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" @click="close" data-dismiss="modal">Cancel</button>
                                    <button @click="butonesyes()" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>

    </div>

</template>

<script>
    import { Form, Field, ErrorMessage } from 'vee-validate';

    export default{
        components: {
            Form,
            Field,
            ErrorMessage
        },
        data() {
            return {
                form:{    
                    phone_number: '',
                    fname: '',
                    lname: '',
                    mname: ''
                },
                edit:{
                    phone_number: '',
                    fname: '',
                    lname: '',
                    mname: ''
                },
                list_of_data: [],
                id: '',
                id_delete: '',
                index: ''
            }
        },mounted(){
            axios.get('/getdata')
                .then((response) => {
                    this.list_of_data = response.data
                })
                .catch((error) => {
                    alert('something went wrong');
            });
        },
        methods: {
            butones(value, index){
                this.id_delete = value.id
                this.index = index
                $('#exampleModalLong').modal('show')
            },
            butonesyes(){
                console.log(this.id_delete)

                axios.delete('/delete/' + this.id_delete)
                .then(response => {

                    $(document).ready(function(){
                        $('#exampleModalLong').modal('hide');
                        $('#toast-delete').toast('show');
                    });

                    this.list_of_data.splice(this.index, 1)
                    
                })
                .catch((error) => {
                    alert('something went wrong');
                });
            },
            validateName(value){
                if(!value){
                    return 'This field is required';
                }

                const regex = /^[a-zA-Z ]+$/i;
                const regexname = /[a-zA-Z ]{20}/;

                if(!regex.test(value)){
                    return 'Please enter letters only';
                }

                if(regexname.test(value)){
                    return 'Name too long';
                }

                return true;
            },
            validatePhone(value){
                if(!value){
                    return 'This field is required';
                }

                const regex = /^(9)[0-9]{9}$/i;

                if(!regex.test(value)){
                    return 'Phone number is invalid';
                }

                return true;
            },
            Submit(){
                console.log("hello tumama ka")

                axios.post('/store', this.form)
                .then(response => {
                    console.log(response.data)
                    this.list_of_data.push(response.data.data)

                    $(document).ready(function(){
                        $('#toast-success').toast('show');
                    });

                })
                .catch((error) => {
                    console.log(error)
                    alert('something went wrong');
                });
            },
            destroy(value, index){
                axios.delete('/delete/' + value.id)
                .then(response => {
                    console.log(response)
                    this.list_of_data.splice(index, 1)

                    $(document).ready(function(){
                        $('#toast-delete').toast('show');
                    });
                })
                .catch((error) => {
                    alert('something went wrong');
                });
            },
            edits(value){
                let str = value.phone_number
                let newStr = str.substring(1)

                this.id = value.id
                this.edit.phone_number = newStr
                this.edit.fname = value.fname
                this.edit.lname = value.lname
                this.edit.mname = value.mname

                $('#exampleModal').modal('show')
            },
            Save(){
                axios.put('/update/' + this.id, this.edit)
                .then(response => {
                    console.log(response)
                    location.reload()
                })
                .catch((error) => {
                    alert('something went wrong');
                });
            },
            close(){
                console.log('hide modal')
                $('#exampleModalLong').modal('hide')
            },
            clickeds(value){
                console.log(value)
            }

        },
    }
</script>