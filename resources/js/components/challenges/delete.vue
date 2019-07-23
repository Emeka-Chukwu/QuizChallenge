<template>
    <div class="container">
        <h3 class="text-danger text-center">
            You are sure you want to delete this challenge ?
        </h3>
        <div>
            <p>{{challenge}}</p>
            <input type="button" value="delete" class="btn btn-danger" @click="deleteData(challengeId)">
        </div>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    data(){
        return  {
            data:[],
        }
    },
    mounted(){
        this.getData();
    },
    methods: {
        getData : function(){
            axios.get('/api/challenges/'+$route.params.id)
            .then(res=> res.json())
            .then(res => {
                this.data = res.data;
            })
        },

        deleteData: function($id){
            axios.delete('/api/challenges/'+$id)
            .then(res=>{
                this.message = " The challenge has been deleted successfully";
                setTimeout(()=>this.$router.push('/questions'), 200 )
            })
        } 
    }
}
</script>

<style>

</style>
