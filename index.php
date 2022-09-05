<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Monaco editor</title>
  <link rel="stylesheet" data-name="vs/editor/editor.main" href="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.0/min/vs/editor/editor.main.min.css">
</head>

<body>

  <button id=ExecuteButton>RUN</button>
  <main>
    <div id="MonacoEditor" style="height:400px;border:1px solid black;"></div>
    <iframe id=iframe src="./files/default.php" frameborder="0"></iframe>
  </main>





  <script src="https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.0/min/vs/loader.min.js"></script>
  <script>
  var editorContent;
  var content = `<?= file_get_contents('./files/default.php') ?>`;
  console.log(content);
  require.config({
    paths: {
      'vs': 'https://cdnjs.cloudflare.com/ajax/libs/monaco-editor/0.34.0/min/vs'
    }
  });
  require(["vs/editor/editor.main"], () => {
    const editor = monaco.editor.create(document.getElementById("MonacoEditor"), {
      value: content,
      // value: `< ?php echo date("l jS \of F Y h:i:s A");`,
      language: 'php',
      lineNumbers: "on",
      roundedSelection: true,
      scrollBeyondLastLine: true,
      readOnly: false,
      minimap: {
        enabled: false
      },
      automaticLayout: true,
      contextmenu: true,
      fontSize: 12,
      scrollbar: {
        useShadows: false,
        vertical: "visible",
        horizontal: "visible",
        horizontalScrollbarSize: 12,
        verticalScrollbarSize: 12
      },
      theme: 'vs-dark',
    });
    editorContent = editor.getValue()

    editor.onDidChangeModelContent(() => {
      editorContent = editor.getValue();
    });
  });
  </script>
  <script>
  //
  // define elements
  //
  var iframe = document.getElementById('iframe');
  var ExecuteButton = document.getElementById('ExecuteButton');

  //
  // style iframe on load $ reload
  //
  window.addEventListener('load', styleIframe);
  iframe.addEventListener('load', styleIframe, true)

  //
  // execute code on button click
  //
  ExecuteButton.addEventListener('click', executeCode);

  //
  // execute code on shortcut ctrl + enter
  //
  window.addEventListener("keyup", (evt) => {
    if (evt.key === "Enter" && evt.ctrlKey) {
      executeCode();
    }
  });





  function styleIframe() {
    iframe.contentDocument.body.style.backgroundColor = "black";
    iframe.contentDocument.body.style.color = "grey";
  }


  function executeCode() {
    fetch('handle.php?execute', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(editorContent),
      })
      .then((response) => response.json())
      .then((data) => {
        console.log(data)
        iframe.contentDocument.location.reload(true);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  }
  </script>


</body>
<style>
main {
  display: flex;
}

iframe {
  width: 45%;
  border: 1px solid black;
}

#MonacoEditor {
  width: 45%;
}
</style>

</html>