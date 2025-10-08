// public/assets/js/chroma-key.js
// Basic green screen (chroma key) removal — works for images/videos via Canvas
function chromaKey(canvas, ctx, img, keyColor = [0,255,0], threshold = 80) {
    ctx.drawImage(img,0,0);
    const imgData = ctx.getImageData(0, 0, canvas.width, canvas.height);
    const data = imgData.data;
    for(let i=0; i<data.length; i+=4) {
      const r=data[i],g=data[i+1],b=data[i+2];
      if(Math.abs(r-keyColor[0])<threshold && Math.abs(g-keyColor[1])<threshold && Math.abs(b-keyColor[2])<threshold){
        data[i+3] = 0; // alpha transparent
      }
    }
    ctx.putImageData(imgData, 0, 0);
  }
  // UI: use <input type="color"> to pick key color, <input type="range"> for threshold. Demo in AR builder.
  