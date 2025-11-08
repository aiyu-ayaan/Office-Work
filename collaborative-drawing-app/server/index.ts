import express from 'express';
import { createServer } from 'http';
import { Server } from 'socket.io';
import cors from 'cors';

const app = express();
app.use(cors());

const httpServer = createServer(app);
const io = new Server(httpServer, {
  cors: {
    origin: "http://localhost:5173",
    methods: ["GET", "POST"]
  }
});

interface DrawData {
  x: number;
  y: number;
  prevX: number;
  prevY: number;
  color: string;
  brushSize: number;
  tool: string;
}

interface ChatMessage {
  user: string;
  message: string;
  timestamp: number;
}

interface User {
  id: string;
  name: string;
}

const rooms = new Map<string, Set<User>>();

io.on('connection', (socket) => {
  console.log('User connected:', socket.id);

  socket.on('join-room', ({ roomId, userName }: { roomId: string; userName: string }) => {
    socket.join(roomId);
    
    if (!rooms.has(roomId)) {
      rooms.set(roomId, new Set());
    }
    
    const user: User = { id: socket.id, name: userName };
    rooms.get(roomId)?.add(user);
    
    console.log(`${userName} joined room ${roomId}`);
    
    // Notify others in the room
    socket.to(roomId).emit('user-joined', { userName, userId: socket.id });
    
    // Send current users list to the new user
    const usersInRoom = Array.from(rooms.get(roomId) || []);
    socket.emit('users-in-room', usersInRoom);
  });

  socket.on('draw', ({ roomId, drawData }: { roomId: string; drawData: DrawData }) => {
    socket.to(roomId).emit('draw', drawData);
  });

  socket.on('clear-canvas', (roomId: string) => {
    socket.to(roomId).emit('clear-canvas');
  });

  socket.on('chat-message', ({ roomId, message, userName }: { roomId: string; message: string; userName: string }) => {
    const chatMessage: ChatMessage = {
      user: userName,
      message,
      timestamp: Date.now()
    };
    io.to(roomId).emit('chat-message', chatMessage);
  });

  socket.on('disconnect', () => {
    console.log('User disconnected:', socket.id);
    
    // Remove user from all rooms
    rooms.forEach((users, roomId) => {
      const userToRemove = Array.from(users).find(u => u.id === socket.id);
      if (userToRemove) {
        users.delete(userToRemove);
        socket.to(roomId).emit('user-left', { userName: userToRemove.name, userId: socket.id });
        
        // Clean up empty rooms
        if (users.size === 0) {
          rooms.delete(roomId);
        }
      }
    });
  });
});

const PORT = process.env.PORT || 3001;

httpServer.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
