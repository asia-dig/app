const fs = require('fs').promises;
 
const loadLocalImage = async () => {
  const imageData = await fs.readFile('/path/to/image.png');
  // Process image data
};