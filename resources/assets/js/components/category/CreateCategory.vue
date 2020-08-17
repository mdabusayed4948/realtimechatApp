<template>
    <v-container>
       <v-form @submit.prevent="submit">
           <v-text-field
               label="Category Name"
               v-model="form.name"
               required
           ></v-text-field>

           <v-btn type="submit" color="teal"><v-icon color="blue-grey darken-4">save</v-icon> Create</v-btn>

       </v-form>

        <v-card>
            <v-toolbar color="indigo" dark dense>
                <v-toolbar-title>Categories</v-toolbar-title>
            </v-toolbar>


                <div v-for="category in categories" :key="category.id" >
                    <v-toolbar dense>
                        <v-list-tile-content>

                            <v-list-title-title>
                                {{ category.name }}
                            </v-list-title-title>
                        </v-list-tile-content>
                        <v-list-tile-action>
                            <v-btn icon small>
                                <v-icon color="orange">edit</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                        <v-list-tile-action>
                            <v-btn icon small>
                                <v-icon color="red">delete</v-icon>
                            </v-btn>
                        </v-list-tile-action>
                    </v-toolbar>
                    <v-divider></v-divider>
                </div>

        </v-card>

    </v-container>
</template>

<script>
export default {
    data(){
        return {
            form: {
                name: null
            },
            categories:{}
        }
    },
    created() {
        axios.get('/api/category')
            .then(res => this.categories = res.data.data)
    },
    methods:{
        submit(){
            axios.post("/api/category", this.form)
            .then(res => console.log(res.data))
        }
    }
}
</script>

<style scoped>

</style>
