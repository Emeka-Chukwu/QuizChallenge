<template>
    <div>   
        <br><br>
        <h4>Take a challenge from {{userName}}</h4>
        <!-- <h4>Quiz about {{topic}} </h4> -->

        <p>
           
        </p>
        <p>Start the quiz </p>
            <router-link to="/quiz">
                <p class="btn btn-primary">
                    Start
                </p>
            </router-link>
            
    
    </div>


</template>

<script>
export default {
    props:['userNa', 'topicame'],
    data(){
        return{
            name: this.userName,
            topic: this.topicName,
            description: '',
            userName: 'emeka',
            topicName: 'topic'

        }
    }

}
</script>

<style>

</style>

