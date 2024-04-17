<template>
    <div class="container">
        <div class="responsive-container responsive-center">
            <div class="titulo text-red">
                <h1>Policies</h1>
            </div>
            <div class="margin4 line-17">
                <h5>Texto de ajuda aqui</h5>
                <br>
                <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, recusandae totam, culpa odit
                    quam, quas fugit repudiandae odio exercitationem quidem cum esse. Doloribus, fugiat facere harum
                    mollitia deserunt maiores voluptates.</h5>
            </div>
        </div>
        <div class="dynamic-box">
            <div class="nav-menu">
                <div class="option" :class="this.optionSelected == 0 ? 'active' : ''" @click="select(0)">
                    <h3>Return</h3>
                </div>
                <div class="option" :class="this.optionSelected == 1 ? 'active' : ''" @click="select(1)">
                    <h3>Privacy</h3>
                </div>
                <div class="option" :class="this.optionSelected == 2 ? 'active' : ''" @click="select(2)">
                    <h3>Shipping</h3>
                </div>
                <div class="option" :class="this.optionSelected == 3 ? 'active' : ''" @click="select(3)">
                    <h3>Terms</h3>
                </div>
                <div class="option" :class="this.optionSelected == 4 ? 'active' : ''" @click="select(4)">
                    <h3>Bulk Orders</h3>
                </div>
            </div>
            <div class="info">
                <div class="option-selected" v-if="optionSelected == 0">
                    <div class="title">
                        <h4><b>Return Policies</b></h4>
                    </div>
                    <div class="text">
                        <div class="text-title">
                            <h5><b>Titulo aqui</b></h5>
                        </div>
                        <div class="text-info">
                            <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est,
                                quidem
                                rerum,
                                accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                                praesentium in
                                vero quaerat quos velit!</h5>
                            <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam
                                architecto
                                maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam
                                exercitationem.
                                Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                            <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                                reprehenderit
                                laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                                Nihil
                                corrupti iure atque similique?</h5>
                        </div>
                    </div>
                </div>
                <div class="option-selected" v-if="optionSelected == 1">
                    <div class="title">
                        <h4><b>Privacy Policies</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
                <div class="option-selected" v-if="optionSelected == 2">
                    <div class="title">
                        <h4><b>Shipping Policies</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
                <div class="option-selected" v-if="optionSelected == 3">
                    <div class="title">
                        <h4><b>Terms</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
                <div class="option-selected" v-if="optionSelected == 4">
                    <div class="title">
                        <h4><b>Bulk Orders</b></h4>
                    </div>
                    <div class="text">
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum, labore odit est, quidem
                            rerum,
                            accusamus corporis dignissimos quibusdam mollitia vel eaque iusto recusandae esse
                            praesentium in
                            vero quaerat quos velit!</h5>
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste distinctio quisquam architecto
                            maiores, doloremque illum sint expedita modi dignissimos facilis unde ipsam exercitationem.
                            Consequatur magni ex neque dolores dolor! Explicabo!</h5>
                        <h5>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Vel quae optio aperiam
                            reprehenderit
                            laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio asperiores?
                            Nihil
                            corrupti iure atque similique?</h5>
                    </div>
                </div>
            </div>
        </div>
        <contact-component></contact-component>
    </div>
</template>

<script>
export default {
    data() {
        return {
            optionSelected: localStorage.getItem('selectedOption'),
        }
    },
    methods: {
        select(n) {
                localStorage.setItem('selectedOption', n);
                this.optionSelected = localStorage.getItem('selectedOption');
        },
        start(){
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
    }
}
</script>