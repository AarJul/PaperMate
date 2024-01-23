const DocumentItem = {
    setup() {
        const documents = Vue.ref([]);

        Vue.onMounted(async () => {
            try {
                const response = await axios.get('http://localhost:80/PaperMate-1/page/php/getAllDoc_json.php');
                documents.value = response.data.documents;
                console.log(documents.value);
            } catch (error) {
                console.error(error);
            }
        });

        const handlePageChange = (id) => {
            localStorage.setItem("documentid", id)
            window.location.href = "/page/steps.html"
        };

        return {
            documents,
            handlePageChange, // Expose the method to the template
        };
    },
<<<<<<< HEAD
    mounted() {
        axios.get('test_allDoc.php') // Adjust the path here
            .then(response => (this.data = response.data))
            .catch(error => console.error(error));
    },
});

app.component('document-item', {
    props: ['documentname', 'documentpics'],
=======
>>>>>>> 686544d5961ce5b71ea3e4fe0a98f6f1820c3e4b
    template: `
        <div class="grid-container">
            <div v-for="document in documents" :key="document.documentid" class="grid-item">
                <h3>{{ document.documentname }}</h3>
                <img v-if="document.documentpics !== null" :src="document.documentpics" :alt="document.documentname" class="img-fluid mb-3">
                <p class="mt-auto mb-auto ms-3">{{ document.documentname }}</p>
                <button @click="handlePageChange(document.documentid)">Check it out</button>
            </div>
        </div>
    `,
};

const app = Vue.createApp({
    setup() {
        return {};
    },
});

// Register the component globally or within another component
app.component('document-item', DocumentItem);
app.mount('#app');