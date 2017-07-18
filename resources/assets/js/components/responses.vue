<template>
    <div> 
        <a href="#" class="btn btn-outline-primary" v-on:click="load">Ver respuestas</a>

        <div class="col-12 mt-2" v-for="response in responses">
            <div class="card">
                
                <div class="card-block">
                {{response.message}}
                </div>
                <div class="card-footer text-muted">
                    Por:{{response.user.name}} en: {{response.created_at}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['message', 'base_url'],
    data() {
        return {
            responses: [],
        }
    },
    methods: {
        load() {
            axios.get(this.base_url + '/api/messages/'+ this.message + '/responses').then(res => {
                this.responses = res.data;    
            });
        }
    }
}
</script>
