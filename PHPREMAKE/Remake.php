<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Editor with Live Preview</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
        }
        #editor-container {
            height: 50%;
        }
        #preview-container {
            height: 50%;
            overflow: auto;
        }
    </style>
    <!-- Load Monaco Editor -->
    <script src="https://unpkg.com/monaco-editor@0.31.0/min/vs/loader.js"></script>
    <script>
        require.config({ paths: { 'vs': 'https://unpkg.com/monaco-editor@0.31.0/min/vs' } });

        require(['vs/editor/editor.main'], function () {
            // Initial HTML code for the editor
            const initialHtmlCode = `<?php echo htmlspecialchars('<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Live Preview
</body>
</html>'); ?>`;

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
            });
        });
    </script>
</head>
<body>
    <!-- Container for the code editor -->
    <div id="editor-container"></div>
    <!-- Container for the live preview -->
    <div id="preview-container">
        <h2>Live Preview</h2>
        <div id="preview"></div>
    </div>
</body>
</html>
