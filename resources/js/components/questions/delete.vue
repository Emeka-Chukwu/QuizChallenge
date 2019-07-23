<template>
    <div class="container">
        <h3 class="text-danger text-center">
            You are sure you want to delete this question
        </h3>
        <div>
            <h2>{{question}}</h2>
            <div v-for="(option, index) in options" :key="index">
                <p>{{option.answer}}</p>
            </div>

            <input type="button" value="delete" class="btn btn-danger" @click="deleteData(questionId)">
        </div>
    </div>
</template>

<script>
import { setTimeout } from 'timers';
export default {
    data(){
        return  {
            data:[],
            question:'',
            options: [],
        }
    },
    mounted(){
        this.getData();
    },
    methods: {
        getData : function(){
            axios.get('/api/questions/show/'+this.$route.params.id)
            .then(res => {
                this.data = res.data.data;
                var getData = res.data.data;
                this.question = getData.question;
                this.options = getData.answer;
                console.log(this.data)
            }).catch(err => console.log(err))
        },

        deleteData: function($id){
            axios.delete('/api/questions/'+$id)
            .then(res=>{
                this.message = " The question has been deleted successfully";
                setTimeout(()=>this.$router.push('/questions'), 200 )
            })
        }
    }
}
</script>

<style>

</style>
