<template>
    <v-container>
        <v-alert v-if="errors" type="error" :value="true">
            Please give category name.
        </v-alert>

        <v-form @submit.prevent="submit">
            <v-text-field
                label="Category Name"
                v-model="form.name"
                required
            ></v-text-field>

           <v-btn type="submit" :disabled="disabled" color="blue" v-if="editSlug">Update</v-btn>
           <v-btn type="submit" :disabled="disabled" color="teal" v-else>Create</v-btn>

       </v-form>
        <v-card>
            <v-toolbar color="indigo" dark dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>

            <div v-for="(category,index) in categories" :key="category.id"  class="mt-1">
                    <v-toolbar dense>
                        <v-list-tile-content>

                            <v-list-tile-title>
                                {{ category.name }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-tooltip top>
                                <v-btn  icon small @click="edit(index)" slot="activator" dark>
                                    <v-icon color="orange">edit</v-icon>
                                </v-btn>
                                <span>Edit</span>
                            </v-tooltip>
                        </v-list-tile-action>
                        <v-list-tile-action>
                            <v-tooltip top>
                                <v-btn icon small @click="destroy(category.slug,index)" slot="activator" dark >
                                    <v-icon color="red">delete</v-icon>
                                </v-btn>
                                <span>Delete</span>
                            </v-tooltip>
                        </v-list-tile-action>

                    </v-toolbar>
                </div>
        </v-card>

    </v-container>

</template>

<script>
import create from "../forum/create";

export default {
    data(){
        return {
            form: {
                name: null
            },
            categories:{},
            editSlug:null,
            errors:null
        }
    },
    created() {
        if (!User.admin()){
            this.$router.push("/forum");
        }
        axios.get('/api/category')
        .then(res => this.categories = res.data.data)
    },
    methods:{

        submit(){
            this.editSlug ? this.update() : this.create();
        },
        update(){
            axios
                .patch(`/api/category/${this.editSlug}`, this.form)
                .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
        },
        create() {
            axios
                .post("/api/category", this.form)
                .then(res => {
                    this.categories.unshift(res.data);
                    this.form.name = null;
                })
                .catch(error => (this.errors = error.response.data.errors));
        },
        destroy(slug,index) {
            axios
                .delete(`/api/category/${slug}`)
                .then(res => this.categories.splice(index,1));
        },
        edit(index){
            this.form.name = this.categories[index].name;
            this.editSlug = this.categories[index].slug;
            this.categories.splice(index,1);
        }
    },
    computed:{
        disabled(){
            return !(this.form.name);
        }
    }
}
</script>

<style scoped>

</style>
