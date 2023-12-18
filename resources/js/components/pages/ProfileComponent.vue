<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="container-info">
                            <img width="170" height="170" class="img-thumbnail float-start me-3" :src="'images/profile_pictures/'+user.picture"/>
                            <h1><b>{{ user.name }}</b></h1>
                            <h3>{{ user.role }} <span v-show="user.career"> de {{ user.career }}</span></h3>
                            <h4>{{ user.email }}</h4>
                            <h4>{{ user.id_card }}</h4>
                        </div>

                        <br>
                        <br>    

                        <form method="POST" action="#" @submit.prevent="updatePassword" @keydown="form.onKeydown($event)">
                            
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ ('Nueva contraseña') }}</label>

                                <div class="col-md-6">
                                    <input v-model="form.new_password" id="new_password" type="password" class="form-control" name="new_password" required autocomplete="new-password">
                                        <div v-if="form.errors.has('new_password')" v-html="form.errors.get('new_password')" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ ('Confirmar nueva contraseña') }}</label>

                                <div class="col-md-6">
                                    <input v-model="form.password_confirmation" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    <div v-if="form.errors.has('password_confirmation')" v-html="form.errors.get('password_confirmation')" />
                                </div>
                            </div>
                            
                            <AlertSuccess :form="form" id="text"></AlertSuccess>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ ('Cambiar contraseña') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let user = document.head.querySelector('meta[name="user"]');
    export default {
        data() {
            return {
                form: new Form({
                    new_password: '',
                    password_confirmation: '',
                })
            }
        },
        computed: {
            user() {
                return JSON.parse(user.content);
            },
        },
        methods: {
            updatePassword() {
                this.form.post('/perfil').then(( response ) => { 
                    var attr = document.getElementById("text");
                    attr.innerHTML = response.data.message;  
                    this.form.reset();
                    console.log("Exito");
                })
            },
        },
        mounted() {
            console.log('Profile mounted.')
        },
    }
</script>
