<template>
    <div>
        
         <nav class="navbar navbar-expand-lg navbar-dark bg-primary primary text-primary" >


  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
      <li class="nav-item active">
        <router-link class="nav-link whyte active" to="questions">Questions <span class="sr-only">(current)</span></router-link>
            

      </li>
      <li class="nav-item">
        <router-link class="nav-link whyte" style="color:white" to="/emeka">Quiz</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link whyte" style="color:white" to="/challenges">Challenges</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link whyte" style="color:white" to="/subjects">Subject</router-link>
      </li>
      <li class="nav-item">
        <router-link class="nav-link whyte" style="color:white" to="/topics">Topic</router-link>
      </li>
      
      <!-- <li class="nav-item">
        <router-link class="nav-link" to="/challenges">Challenges</router-link>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
 
  </div>
</nav>

        
        <div>
            <!-- <router-link to="/emeka"> quiz</router-link>
            <router-link to="user"> user</router-link>
            <router-link to="/questions">Questions</router-link>
            <router-link to="/challenges">Challenges</router-link>
            <router-link to="/subjects">Subject</router-link>
            <router-link to="/topics">Topic</router-link> -->
            
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
  .whyte{
    color:#ffffff;
  }
</style>
