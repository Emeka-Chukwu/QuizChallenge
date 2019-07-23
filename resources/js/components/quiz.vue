<template>
    <div>   
        <h2>Take a challenge from {{userNmae}}</h2>
        <h4>Quiz about {{topic}} </h4>

        <p>
            {{description}} or some texts will be here
        </p>
        <p>Start the quiz </p>
            <router-link to="/">
                <p class="btn btn-primary">
                    Start
                </p>
            </router-link>
            
    
    </div>


</template>

<script>
export default {
    // props:['userName', 'topicName'],
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

