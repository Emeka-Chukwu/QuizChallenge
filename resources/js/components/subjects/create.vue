<template>
   <div class="container">
       <br>
       <form @submit="formSubmit" enctype="multipart/form-data" >
        <!-- <form @submit="formSubmit" enctype="multipart/form-data"> -->

       <!-- selecting the subject, topic and the challenge (which was set by the user ) and using the challenge_id (that is the 
       value of the challenge) to insert into challenge_id which is in the questions table -->

            <!-- the topic selection for querying the database for where condition in the controller -->

          <!-- the challenge selection for querying the database for where condition in the controller -->



       <!-- the Question -->
           <div class="form-group">
               <label for="question"> Subject</label>
               <input type="text" name="" id="" v-model="subject" placeholder="Enter your Subject" class="form-control">
           </div>

           <div class="form-group">
               <label for="question">Description</label>
               <input type="text" name="" id="" v-model="description" placeholder="Enter Description" class="form-control">
           </div>

           <div class="form-group">
               <input type="submit" value="Create" class="btn btn-primary">
           </div>
        
       </form>
        
   </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    props:[],
    data(){
        return{
          
            subject: '',
            description:'',
        }
    },
    mounted(){
        
    },
    methods:{
        // to be called immediately the page loads
        
        formSubmit : function(e)
        {

            e.preventDefault();
            const config = {
                headers: {'contents-type' : 'multipart/form-data'}
            }
            alert('form is submitted')
           

            var formdata = new FormData();
            formdata.append('subject', this.subject);
            formdata.append('description', this.description);
            

            axios.post('/api/subjects', formdata)
            .then(res=>{
                console.log(res)
                this.message = "Subject has been created successfully";
                setTimeout(()=>this.$router.push('/questions'), 1500)
                // this.$router.push('/')
            }).catch(err =>{
                    this.messageError = " question not submitted ";
                })

                // this.$router.push('/')
                // console.log(formdata.entries)
        },

    }

}
</script>

<style>

</style>
