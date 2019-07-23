<template>
    <div>
        <h3>
            Navigation will be;
        </h3>
        <div>
            <router-link to="/emeka"> quiz</router-link>
            <router-link to="user"> user</router-link>
            <router-link to="/"> home</router-link>
            <router-link to="/questions">Questions</router-link>
            <router-link to="/challenges">Challenges</router-link>
            <router-link to="/subjects">Subject</router-link>
            <router-link to="/topics">Topic</router-link>
            
            <router-view :user-id="userId"
            :user-name="userName" ></router-view>

        </div>
    </div>
</template>

<script>
export default {
    props:['userId', 'challengeName', 'userName']
}
</script>

<style>

</style>
