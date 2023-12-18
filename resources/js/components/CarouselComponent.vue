<template>
    <Splide :options="options" :extensions="extensions" aria-label="Tesis">
        <SplideSlide v-for="tesis in teses" :key="tesis">
            <div class="preview">
                <img src="/images/bookthumbnail.webp" alt="" >
                <span>{{ tesis.title }}</span>
                <div class="options">
                    <a href="#" onclick="return false;" @click="open(tesis.filename, tesis.title, tesis.user_id)"><i class="fa-solid fa-eye fa-xl"></i></a>
                    <a :href="'/trabajos/'+tesis.filename" download><i class="fa-solid fa-download fa-xl"></i></a>
                </div>
            </div>
        </SplideSlide>
    </Splide>

    <Teleport to="body">
        <!-- use the modal component, pass in the prop -->
        <modal :show="showModal" @close="showModal = false">
            <template #header>
                <h3>{{ tesisTitle }} por {{ tesisAutor }}</h3>
            </template>
            <template #body>
                <iframe width="100%" height="500px" :src="'trabajos/'+tesisFilename+'#page=0'" frameborder="0"></iframe>
            </template>
            <template #footer>
                <h3></h3>
            </template>
        </modal>
    </Teleport>
</template>

<script>
    import { Splide, SplideSlide } from '@splidejs/vue-splide';
    import { Grid } from '@splidejs/splide-extension-grid';
    import '@splidejs/vue-splide/css';
    
    import { defineComponent } from 'vue';
    import Modal from './Modal.vue'

    export default defineComponent( {
        components: {
            Splide,
            SplideSlide,
            Modal,
        },
        data() {
            return {
                showModal: false,
                tesisFilename: null,
                tesisTitle: null,
                tesisAutor: null
            }
        },
        setup() {
            
            const options = {
                rewind: true,
                type: 'loop',
                fixedHeight: 380,
                gap: 20,
                speed: 1000,
                rewindSpeed: 1000,
                grid: {
                    rows: 2,
                    cols: 5,
                    gap : {
                        row: '1.5rem',
                        col: '1.75rem',
                    },
                },
            };

            return {
                options,
                extensions: { Grid },
            }
        },
        methods: {
            open(filename, title, autorID) {
                this.showModal = true,
                this.tesisFilename = filename,
                this.tesisTitle = title,
                this.tesisAutor = this.students.find(student => student.id === autorID).name
            }
        },
        props: ['teses', 'students'],
        mounted() {
            console.log('Carousel mounted.')
        },
    });    
    
</script>

<style>
    .preview img {
        float: left;
        width: 60%;
        height: 100%;
    }

    .preview span {
        position: absolute;
        margin-top: 15px;
        text-overflow: ellipsis;
        transform: translateX(-6%);
    }

    .options {
        width: 110%;
        height: 100%;
        position: absolute;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .4);
        opacity: 0;
        transition: 0.5s;
        transform: translateY(0%);
    }

    .options i {
        font-size: 30px;
        margin: 0 10px;
    }

    .preview:hover .options {
        opacity: 1;
    }

    .splide__arrow--next {
        right: 0.1em;
    }

    .splide__arrow--prev {
        left: 0.1em;
    }

    .splide__track {
        margin-left: 20px;
        margin-right: 20px;
    }
</style>
