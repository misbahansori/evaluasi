<template>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Daftar Group/Bagian</h4>
                    <a href="/master/group/create" class="btn btn-success btn-sm">
                        <i class="ti ti-pencil-alt"></i> Tambah Group
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:20px">No</th>
                            <th>Nama Group</th>
                        </tr>
                        <tr v-for="(role, index) in roles" :key="role.id">
                            <td v-text="index + 1"></td>
                            <td><a href="#" @click.prevent="getPermissions(role)" v-text="role.name"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6" v-if="role">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between">
                    <h4>Hak Akses {{ role.name }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:20px">No</th>
                            <th>Hak Akses</th>
                        </tr>
                        <tr v-for="(permission, index) in rolePermissions" :key="permission.id">
                            <td v-text="index + 1"></td>
                            <td v-text="permission.name"></td>
                        </tr>
                        <tr v-if="!rolePermissions.length">
                            <td colspan="2" class="text-center"><i>Tidak ada hak akses.</i></td>
                        </tr>
                    </table>
                    <div class="d-flex">
                        <select class="form-control mr-2" v-model="permission_id">
                            <label>Tambah Hak Akses</label>
                            <option value="" disabled>--- Silahkan pilih hak akses ---</option>
                            <option v-for="permission in permissions" :key="permission.id" :value="permission.id" v-text="permission.name"></option>
                        </select>
                        <button class="btn btn-success" @click="submitPermission()">
                            <i class="ti ti-plus"></i> Tambah
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props : {
        roles : Array,
        permissions : Array
    },
    data() {
        return {
            rolePermissions : [],
            role : '',
            permission_id : ''
        }
    },
    methods : {
        getPermissions(role) {
            axios.get(`/master/group/${role.id}`).then(res => {
                this.rolePermissions = res.data
                this.role = role
            })
        },
        submitPermission() {
            axios.post(`/master/permission/${this.permission_id}`, {
                'role_id' : this.role.id
            }).then(res => {
                if (res.data.success) {
                    this.getPermissions(this.role)
                }
            }).catch(err => console.log(err))
            this.permission_id = ''
        }
    }
}
</script>
