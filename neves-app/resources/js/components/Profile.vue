<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        {{ user }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { RouterLink } from 'vue-router';

export default {
    props:{
        user:{
            type: Object,
            required: true
        }
  },
    data() {
        return {
            // user : { data:[] }
        }
    },
    methods: {

        // getUser() {
        //     const cookieValue = document.cookie.split("; ").find((row) => row.startsWith("token="))?.split("=")[1];
        //     let url = "http://localhost:8000/api/user"


        //     axios.get(url, {
        //         headers: {
        //             'Authorization': 'Bearer ' + cookieValue,
        //             // 'X-XSRF-TOKEN' : this.csrf_token
        //         }
        //     })
        //         .then(response => {
        //             if(response.data.email_verified_at == null){
        //                 window.location.replace("/verify-email");
        //             }
        //             this.user.data = response.data
        //             console.log(response)
        //         })
        //         .catch(errors => {
        //             console.log(errors);
        //         })
        // },


    },
    mounted() {
        // console.log(this.id)
        // this.getUser()
    }
}
</script>