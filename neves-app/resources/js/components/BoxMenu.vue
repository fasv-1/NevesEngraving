<template>
        <div class="dynamic-box" >
            <!-----------------------------------------Box menu--------------------------------------------->
            <div class="box-menu" >
                <div class="option" v-for="title, index in titles" :key="index" :class="this.optionSelected == index ? 'active' : ''" @click="select(index)">
                    <h3>{{ title }}</h3>
                </div>
            </div>
            <div class="info">
                <!-----------------------------------------Return info--------------------------------------------->
                <div class="option-selected" v-for="title, index in titles" :key="index" >
                    <slot :name="title" v-if="optionSelected == index"></slot>
                </div>

               
            </div>
        </div>
</template>

<script>
export default {
  props:['titles'],
    data() {
        return {
            optionSelected: localStorage.getItem('selectedOption'), // saves the page if the browser reloads
        }
    },
    methods: {
        timeOut() {
            setTimeout(() => { // selects a page after a timeout
                if (this.$route.query.policie) {
                    localStorage.setItem('selectedOption', this.$route.query.policie);
                    this.optionSelected = localStorage.getItem('selectedOption');
                }
            }, 200);
        },
        select(n) { //selects the info from the button clicked
                localStorage.setItem('selectedOption', n);
                this.optionSelected = localStorage.getItem('selectedOption');
        },
        start(){ // sets the first info to appears
            let selected = localStorage.getItem('selectedOption');

            if(selected == undefined){
                localStorage.setItem('selectedOption', 0);
                this.optionSelected = localStorage.getItem('selectedOption');
            }
        }
    },
    computed: {

    },
    mounted() {
        this.start()
        this.timeOut()
    }
}
</script>