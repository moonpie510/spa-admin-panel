<script>
import { Form, Field } from 'vee-validate';
import * as yup from 'yup';

export default {
    name: "ListUsers",
    components: {
      Form,
      Field,
    },

    setup() {
        const schema = yup.object({
            name: yup.string().required(),
            email: yup.string().email().required(),
            password: yup.string().required().min(8)
        });

        return {
            schema
        };
    },

    data() {
        return {
            users: [],
        }
    },

    methods: {
        getUsers() {
            axios.get('/api/users')
                .then((res) => {
                    this.users = res.data;
                })
        },

        createUser(values, {resetForm}) {
            axios.post('/api/users', values)
                .then(res => {
                    document.getElementById('closeModal').click();
                    this.getUsers();
                    resetForm();
                })
        }

        /*createUser(values, {resetForm}) {
            axios.post('/api/users', values)
                .then(res => {
                    document.getElementById('closeModal').click();
                    this.getUsers();
                    resetForm();
                })
        },*/


    },

    mounted() {
        this.getUsers();
    },
}
</script>

<template>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 test">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="content">
        <div class="container-fluid">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#userFormModal">
                Добавить
            </button>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Email</th>
                            <th scope="col">Дата регистрации</th>
                            <th scope="col">Роль</th>
                            <th scope="col">Опции</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(user, index) in users">
                            <td>{{index + 1}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td>{{user.created_at}}</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="userFormModal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавить нового пользователя</h5>
                    <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <Form @submit="createUser" :validation-schema="schema" v-slot="{errors}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <Field name="name" type="text" class="form-control" :class="{'is-invalid': errors.name}" id="name"
                                   aria-describedby="nameHelp" placeholder="Введите имя" />
                            <span class="invalid-feedback">{{errors.name}}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <Field name="email" type="email" class="form-control" :class="{'is-invalid': errors.email}" id="email"
                                   aria-describedby="nameHelp" placeholder="Введите email" />
                            <span class="invalid-feedback">{{errors.email}}</span>
                        </div>

                        <div class="form-group">
                            <label for="email">Password</label>
                            <Field name="password" type="password" class="form-control" :class="{'is-invalid': errors.password}" id="password"
                                   aria-describedby="nameHelp" placeholder="Введите пароль" />
                            <span class="invalid-feedback">{{errors.password}}</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </Form>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
