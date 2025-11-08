import { useEffect, useState } from 'react';
import { useParams, useLocation, useNavigate } from 'react-router-dom';
import Canvas from '../components/Canvas';
import Chat from '../components/Chat';
import Toolbar from '../components/Toolbar';
import { useSocket } from '../utils/socket';
import './DrawingRoom.css';

const DrawingRoom = () => {
  const { roomId } = useParams<{ roomId: string }>();
  const location = useLocation();
  const navigate = useNavigate();
  const socket = useSocket();
  
  const [userName, setUserName] = useState('');
  const [showChat, setShowChat] = useState(false);
  const [copied, setCopied] = useState(false);

  useEffect(() => {
    const name = location.state?.userName;
    
    if (!name) {
      // If no name is provided, redirect to home
      navigate('/');
      return;
    }
    
    setUserName(name);
    
    if (socket && roomId) {
      // Join the room
      socket.emit('join-room', { roomId, userName: name });
      
      // Listen for users in room
      socket.on('users-in-room', () => {
        // Users list received - can be used to display active users
      });
      
      // Listen for new users joining
      socket.on('user-joined', ({ userName: newUserName }: { userName: string; userId: string }) => {
        console.log(`${newUserName} joined the room`);
      });
      
      // Listen for users leaving
      socket.on('user-left', ({ userName: leftUserName }: { userName: string; userId: string }) => {
        console.log(`${leftUserName} left the room`);
      });
    }
    
    return () => {
      if (socket) {
        socket.off('users-in-room');
        socket.off('user-joined');
        socket.off('user-left');
      }
    };
  }, [socket, roomId, location.state, navigate]);

  const copyRoomUrl = () => {
    const url = window.location.href;
    navigator.clipboard.writeText(url);
    setCopied(true);
    setTimeout(() => setCopied(false), 2000);
  };

  return (
    <div className="drawing-room">
      <header className="room-header">
        <div className="header-left">
          <h2>Drawing Room</h2>
          <span className="user-name">👤 {userName}</span>
        </div>
        
        <div className="header-center">
          <div className="room-info">
            <span className="room-id">Room: {roomId}</span>
            <button onClick={copyRoomUrl} className="copy-button">
              {copied ? '✓ Copied!' : '📋 Copy Link'}
            </button>
          </div>
        </div>
        
        <div className="header-right">
          <button 
            onClick={() => setShowChat(!showChat)} 
            className={`chat-toggle ${showChat ? 'active' : ''}`}
          >
            💬 Chat {showChat ? '(Hide)' : '(Show)'}
          </button>
        </div>
      </header>

      <div className="room-content">
        <div className="canvas-container">
          <Toolbar />
          <Canvas roomId={roomId || ''} socket={socket} />
        </div>
        
        {showChat && (
          <div className="chat-container">
            <Chat roomId={roomId || ''} userName={userName} socket={socket} />
          </div>
        )}
      </div>
    </div>
  );
};

export default DrawingRoom;
