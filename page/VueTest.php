<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

    <div id="app">{{ message }}</div>

    <script>
        const {
            createApp,
            ref
        } = Vue

        createApp({
            setup() {
                const message = ref('Hello vue!')
                return {
                    message
                }
            }
        }).mount('#app')
    </script>
</body>

</html>