require.config({
    paths: { 'vs': 'https://unpkg.com/monaco-editor@0.31.0/min/vs' }
});

require(['vs/editor/editor.main'], function () {
    // Initial HTML code for the editor
    const initialHtmlCode = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
        
    </script>
</body>
</html>`;

    // Create a new Monaco editor instance
    const editor = monaco.editor.create(document.getElementById('editor-container'), {
        value: initialHtmlCode, // Set initial HTML code
        language: 'html',
        theme: 'vs-dark',
        automaticLayout: true,
    });

    // Listen for changes in the editor
    editor.getModel().onDidChangeContent(() => {
        // Get the code from the editor
        const code = editor.getValue();
        // Update the live preview with the code
        document.getElementById('preview').innerHTML = code;

        // Execute embedded JavaScript code
        executeEmbeddedJavaScript(code);
    });

    // Function to execute embedded JavaScript code
    function executeEmbeddedJavaScript(htmlCode) {
        const regex = /<script>([\s\S]*?)<\/script>/g;
        let match;
        while ((match = regex.exec(htmlCode)) !== null) {
            const scriptCode = match[1];
            const scriptElement = document.createElement('script');
            scriptElement.textContent = scriptCode;
            document.body.appendChild(scriptElement);
        }
    }
});
