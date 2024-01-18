const stepsItem = {
    setup() {
        const docSteps = Vue.ref([]);
        const documentid = localStorage.getItem("documentid");
        console.log("documentid:", documentid);

        Vue.onMounted(async () => {
            try {
                // Send a POST request to the PHP script with documentid
                const response = await axios.post('http://localhost:80/PaperMate-1/page/php/getAllSteps_json.php', {
                    documentid: documentid
                });

                // Use response.data.steps instead of response.data.docSteps
                docSteps.value = response.data.steps;
                console.log(docSteps.value);
            } catch (error) {
                console.error(error);
            }
        });

        const handlePageChange = (id) => {
            localStorage.setItem("stepsid", id);
            window.location.href = "/page/stepDetail.html";
        };

        return {
            docSteps,
            handlePageChange,
        };
    },
    template: `
        <div class="grid-container">
            <div v-for="steps in docSteps" :key="steps.stepsid" class="grid-item">
                <h3>{{ steps.stepsname }}</h3>
                <img v-if="steps.stepspic !== null" :src="steps.stepspic" :alt="steps.stepsname" class="img-fluid mb-3">
                <p class="mt-auto mb-auto ms-3">{{ steps.stepsname }}</p>
                <button @click="handlePageChange(steps.stepsid)">Details and Posts</button>
            </div>
        </div>
    `,
};

const app = Vue.createApp({
    setup() {
        return {};
    },
});

app.component('steps-item', stepsItem);
app.mount('#app');
