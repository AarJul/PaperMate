const stepDetail = {
    setup() {
        const StepsPost = Vue.ref([]);
        const stepsid = localStorage.getItem("stepsid");
        console.log("stepsid:", stepsid);

        const params = new URLSearchParams();
        params.append('stepsid', stepsid);

        Vue.onMounted(async () => {
            try {
                // Send a POST request to the PHP script with stepsid
                const response = await axios.post('http://localhost:80/PaperMate-1/page/php/getAllStepsPost_json.php', params);
                console.log("Sending request with stepsid:", stepsid);
                console.log("Response:", response);

                // Use response.data.posts instead of response.data.steps
                StepsPost.value = response.data.posts;
                console.log(StepsPost.value);
            } catch (error) {
                console.error(error);
            }
        });

        const handlePageChange = (id) => {
            localStorage.setItem("postid", id);
            window.location.href = "/page/stepPostDetail.html";
        };

        return {
            StepsPost,
            handlePageChange,
        };
    },
    template: `
        <div class="grid-container">
            <div v-for="post in StepsPost" :key="post.postid" class="grid-item">
                <h3>{{ post.postname }}</h3>
                <!-- Update the rest of your template accordingly -->
                <button @click="handlePageChange(post.postid)">Details and Posts</button>
            </div>
        </div>
    `,
};

const app = Vue.createApp({
    setup() {
        return {};
    },
});

app.component('stepPost-item', stepDetail);
app.mount('#app');
