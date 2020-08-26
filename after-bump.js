const fs = require("fs");
const path = require("path");
const filename = path.join(__dirname, "hur-snippets.php");
const version = process.argv[2];
let content = fs.readFileSync(filename).toString("utf-8");
content = content.replace(/\* Version: ([0-9\.]+)/, "* Version: " + version);
fs.writeFileSync(filename, content);
