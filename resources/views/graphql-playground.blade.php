<!DOCTYPE html>
<html>
<head>
    <title>GraphQL Playground</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/graphql-playground-react@1.7.26/build/static/css/index.css" />
    <script src="//cdn.jsdelivr.net/npm/graphql-playground-react@1.7.26/build/static/js/middleware.js"></script>
</head>
<body>
<div id="root"></div>
<script type="text/javascript">
    window.addEventListener('load', function (event) {
        const root = document.getElementById('root');
        GraphQLPlayground.init(root, {
            endpoint: '/graphql'
        })
    })
</script>
</body>
</html>
