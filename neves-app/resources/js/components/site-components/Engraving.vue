<template>
    <div class="container">

        <div class="dynamic-box">
            <!----------------------------------------- Image menu --------------------------------------------->
            <div id="option" class="img-menu" @scroll="scroll">
                <div class="option" @click="select(0)">
                    <img src="@/images/gerais/woodEngrv.jpg" alt="wood-link">
                    <div class="blur" :class="this.optionSelected == 0 ? 'active' : ''"></div>
                    <div class="eng-name" :class="this.optionSelected == 0 ? 'active' : ''">Wood</div>
                </div>
                <div class="option" :class="this.optionSelected == 1 ? 'active' : ''" @click="select(1)">
                    <img src="@/images/gerais/acrylicEngrv.jpg" alt="wood-link">
                    <div class="blur" :class="this.optionSelected == 1 ? 'active' : ''"></div>
                    <div class="eng-name" :class="this.optionSelected == 1 ? 'active' : ''">Acrylic</div>
                </div>

                <div class="option" :class="this.optionSelected == 2 ? 'active' : ''" @click="select(2)">
                    <img src="@/images/gerais/alumEngrv.jpg" alt="wood-link">
                    <div class="blur" :class="this.optionSelected == 2 ? 'active' : ''"></div>
                    <div class="eng-name" :class="this.optionSelected == 2 ? 'active' : ''">Aluminium</div>
                </div>

                <div class="option" :class="this.optionSelected == 4 ? 'active' : ''" @click="select(4)">
                    <img src="@/images/gerais/glassEngrv.jpg" alt="wood-link">
                    <div class="blur" :class="this.optionSelected == 4 ? 'active' : ''"></div>
                    <div class="eng-name" :class="this.optionSelected == 4 ? 'active' : ''">Glass</div>
                </div>
                <div class="option" :class="this.optionSelected == 5 ? 'active' : ''" @click="select(5)">
                    <img src="@/images/gerais/cardEngrv.jpeg" alt="wood-link">
                    <div class="blur" :class="this.optionSelected == 5 ? 'active' : ''"></div>
                    <div class="eng-name" :class="this.optionSelected == 5 ? 'active' : ''">Business Cards</div>
                </div>
            </div>
            <div class="info brd-none">
                <!-----------------------------------------Wood info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 0">
                    <div class="title">
                        <h4><b>Wood</b></h4>
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
                                laboriosam nam. Similique vel quam corrupti velit atque sint est distinctio
                                asperiores?
                                Nihil
                                corrupti iure atque similique?</h5>
                        </div>
                    </div>
                </div>
                <!-----------------------------------------Acrylic info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 1">
                    <div class="title">
                        <h4><b>Acrylic</b></h4>
                    </div>
                    <div class="text">
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
                <!-----------------------------------------Aluminium info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 2">
                    <div class="title">
                        <h4><b>Aluminium</b></h4>
                    </div>
                    <div class="text">
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
                <!-----------------------------------------Glass info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 4">
                    <div class="title">
                        <h4><b>Glass</b></h4>
                    </div>
                    <div class="text">
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
                <!-----------------------------------------Business Cards info--------------------------------------------->
                <div class="option-selected" v-if="optionSelected == 5">
                    <div class="title">
                        <h4><b>Business Cards</b></h4>
                    </div>
                    <div class="text">
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
        </div>
        <contact-component></contact-component>
    </div>

</template>

<script>
export default {
    data() {
        return {
            optionSelected: localStorage.getItem('selectedOption'),
            scrollPosition: 0,
        }
    },
    methods: {
        scroll(e) {
            this.scrollPosition = e.target.scrollLeft;
        },
        select(n) {
            localStorage.setItem('selectedOption', n);
            this.optionSelected = localStorage.getItem('selectedOption');
            let option = document.getElementById('option');

            if(window.innerWidth <= 440){
                option.scrollTo((n * 120), 0)
            }else{
                option.scrollTo((n * 100), 0)
            }
        },
        start() {
            let selected = localStorage.getItem('selectedOption');

            if (selected == undefined) {
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
