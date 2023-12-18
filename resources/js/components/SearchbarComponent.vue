<template>
    <div class="search float-end">
        <input 
            class="form-control me-2" 
            :class="showBar"
            type="search" 
            name="searchN"
            placeholder="Buscar" 
            aria-label="Buscar"
            v-model="query"
            @input="search">
        <div class="btnS">
            <i class="fa-solid fa-search icon"></i>
        </div>
        <ul class="result-list" :class="showList">
            <li v-for="tesis in teses" :key="tesis" class="result-item">
                <a class="result-link" 
                href="#" onclick="return false;" 
                @click="open(tesis.filename, tesis.title, tesis.user_id)">
                    <div class="result-title">{{ tesis.title }}</div>
                    <div class="result-autor">{{ autor(tesis.user_id) }}</div>
                </a>
            </li>
        </ul>
    </div>

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

    import Modal from './Modal.vue'

    export default {
        components: {
            Modal,
        },
        data() {
            return {
                query: '',
                teses: [],
                autors: [],
                showModal: false,
                tesisFilename: null,
                tesisTitle: null,
                tesisAutor: null,
            }
        },
        computed: {
            showBar() {
                return (this.query.length > 0) ? 'show' : 'hide'
            },
            showList() {
                return (this.query.length > 0) ? 'show' : 'hide'
            }
        },
        methods: {
            search() {
                if (this.query.length >= 3) {
                    axios.post('/home/search', {
                        searchN: this.query
                    }).then(res => {
                        this.teses = res.data.teses,
                        this.autors = res.data.autors 
                    }).catch(error => {
                        console.log(error.response)
                    })
                }
            },
            open(filename, title, autorID) {
                this.showModal = true,
                this.tesisFilename = filename,
                this.tesisTitle = title
                this.tesisAutor = this.autors.find(student => student.id === autorID).name
            },
            autor(autorID) {
                return this.autors.find(student => student.id === autorID).name
            }
        },
        mounted() {
            console.log('Search Bar mounted.')
        },

    }
</script>

<style>
    .search {
        position: relative;
    }

    .search input {
        width: 0;
        transition: 0.5s;
        visibility: hidden;
    }

    .btnS {
        top: 5px;
        right: 10px;
        position: absolute;
        color: blue;
        cursor: pointer;
        border: 0;
    }

    .btnS:hover {
        color: blue;
    }

    .search:hover input {
        visibility: visible;
        width: 240px;
    }

    .search input:focus {
        visibility: visible;
        width: 240px;
    }

    .search input.show {
        visibility: visible;
        width: 240px;
    }

    .result-list.show {
        position: absolute;
        width: 240px;
        overflow-y: auto;
        list-style: none;
        background: #fff;
        padding: 0;
        top: 40px;
        border-radius: 10px;
        box-shadow: 1px 2px 8px 0px #b5b5b5;
        z-index: 10;
    }

    .result-list.hide {
        display: none;
    }

    .result-item {
        border-bottom: 1px solid #ececec;
    }

    .result-link {
        display: block;
        background: #f9f9f9;
        color: #333;
        text-decoration: none;
        padding: 10px 15px;
    }

    .result-title {
        font-size: 16px;
        font-weight: bold;
    }

    .result-autor {
        font-size: 12px;
    }
</style>
