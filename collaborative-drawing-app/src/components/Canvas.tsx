import { useEffect, useRef, useState } from 'react';
import { Socket } from 'socket.io-client';
import './Canvas.css';

interface CanvasProps {
  roomId: string;
  socket: Socket | null;
}

interface DrawData {
  x: number;
  y: number;
  prevX: number;
  prevY: number;
  color: string;
  brushSize: number;
  tool: string;
}

const Canvas = ({ roomId, socket }: CanvasProps) => {
  const canvasRef = useRef<HTMLCanvasElement>(null);
  const [isDrawing, setIsDrawing] = useState(false);
  const [currentColor, setCurrentColor] = useState('#000000');
  const [brushSize, setBrushSize] = useState(2);
  const [currentTool, setCurrentTool] = useState('pen');

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    // Set canvas size to match container
    const resizeCanvas = () => {
      const container = canvas.parentElement;
      if (container) {
        canvas.width = container.clientWidth;
        canvas.height = container.clientHeight;
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
      }
    };

    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    return () => {
      window.removeEventListener('resize', resizeCanvas);
    };
  }, []);

  useEffect(() => {
    if (!socket) return;

    const handleDraw = (drawData: DrawData) => {
      const canvas = canvasRef.current;
      if (!canvas) return;

      const ctx = canvas.getContext('2d');
      if (!ctx) return;

      drawLine(ctx, drawData);
    };

    const handleClearCanvas = () => {
      const canvas = canvasRef.current;
      if (!canvas) return;

      const ctx = canvas.getContext('2d');
      if (!ctx) return;

      ctx.fillStyle = 'white';
      ctx.fillRect(0, 0, canvas.width, canvas.height);
    };

    socket.on('draw', handleDraw);
    socket.on('clear-canvas', handleClearCanvas);

    return () => {
      socket.off('draw', handleDraw);
      socket.off('clear-canvas', handleClearCanvas);
    };
  }, [socket]);

  const drawLine = (ctx: CanvasRenderingContext2D, drawData: DrawData) => {
    ctx.beginPath();
    ctx.moveTo(drawData.prevX, drawData.prevY);
    ctx.lineTo(drawData.x, drawData.y);
    ctx.strokeStyle = drawData.color;
    ctx.lineWidth = drawData.brushSize;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    
    if (drawData.tool === 'eraser') {
      ctx.globalCompositeOperation = 'destination-out';
    } else {
      ctx.globalCompositeOperation = 'source-over';
    }
    
    ctx.stroke();
    ctx.closePath();
  };

  const startDrawing = (e: React.MouseEvent<HTMLCanvasElement>) => {
    setIsDrawing(true);
    const canvas = canvasRef.current;
    if (!canvas) return;

    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    ctx.beginPath();
    ctx.moveTo(x, y);
  };

  const draw = (e: React.MouseEvent<HTMLCanvasElement>) => {
    if (!isDrawing) return;

    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const drawData: DrawData = {
      x,
      y,
      prevX: e.clientX - rect.left - e.movementX,
      prevY: e.clientY - rect.top - e.movementY,
      color: currentColor,
      brushSize,
      tool: currentTool,
    };

    drawLine(ctx, drawData);

    if (socket) {
      socket.emit('draw', { roomId, drawData });
    }
  };

  const stopDrawing = () => {
    setIsDrawing(false);
  };

  const clearCanvas = () => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    ctx.fillStyle = 'white';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    if (socket) {
      socket.emit('clear-canvas', roomId);
    }
  };

  return (
    <div className="canvas-wrapper">
      <div className="canvas-controls">
        <div className="control-group">
          <label>Tool:</label>
          <select value={currentTool} onChange={(e) => setCurrentTool(e.target.value)}>
            <option value="pen">Pen</option>
            <option value="brush">Brush</option>
            <option value="eraser">Eraser</option>
          </select>
        </div>

        <div className="control-group">
          <label>Color:</label>
          <input
            type="color"
            value={currentColor}
            onChange={(e) => setCurrentColor(e.target.value)}
            disabled={currentTool === 'eraser'}
          />
        </div>

        <div className="control-group">
          <label>Size: {brushSize}</label>
          <input
            type="range"
            min="1"
            max="50"
            value={brushSize}
            onChange={(e) => setBrushSize(Number(e.target.value))}
          />
        </div>

        <button onClick={clearCanvas} className="clear-button">
          Clear Canvas
        </button>
      </div>

      <canvas
        ref={canvasRef}
        onMouseDown={startDrawing}
        onMouseMove={draw}
        onMouseUp={stopDrawing}
        onMouseLeave={stopDrawing}
        className="drawing-canvas"
      />
    </div>
  );
};

export default Canvas;
