// Use the CDN version of Axios
const axios = window.axios;

const app = Vue.createApp({
    data() {
        return {
            data: null,
        };
    },
    mounted() {
        axios.get('test_allDoc.php') // Adjust the path here
            .then(response => (this.data = response.data))
            .catch(error => console.error(error));
    },
});

app.component('document-item', {
    props: ['documentname', 'documentpics'],
    template: `
        <div class="grid-item">
            <h3>{{ documentname }}</h3>
            <div class="d-flex">
                <img :src="documentpics" :alt="title" class="img-fluid mb-3">
                <p class="mt-auto mb-auto ms-3">{{ description }}</p>
            </div>
        </div>
    `,
});

app.mount('#app');
