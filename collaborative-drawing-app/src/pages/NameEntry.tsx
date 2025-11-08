import { useState, type FormEvent } from 'react';
import { useNavigate } from 'react-router-dom';
import './NameEntry.css';

const NameEntry = () => {
  const [name, setName] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = (e: FormEvent) => {
    e.preventDefault();
    
    if (name.trim().length < 2) {
      setError('Name must be at least 2 characters long');
      return;
    }
    
    if (name.trim().length > 20) {
      setError('Name must be less than 20 characters');
      return;
    }

    // Generate a unique room ID
    const roomId = Math.random().toString(36).substring(2, 9);
    
    // Navigate to drawing room with user name and room ID
    navigate(`/room/${roomId}`, { state: { userName: name.trim() } });
  };

  return (
    <div className="name-entry-container">
      <div className="name-entry-card">
        <h1>Collaborative Drawing Room</h1>
        <p className="subtitle">Enter your name to start drawing</p>
        
        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <input
              type="text"
              value={name}
              onChange={(e) => {
                setName(e.target.value);
                setError('');
              }}
              placeholder="Enter your name"
              className="name-input"
              autoFocus
            />
            {error && <p className="error-message">{error}</p>}
          </div>
          
          <button type="submit" className="submit-button">
            Create Drawing Room
          </button>
        </form>
        
        <div className="info-section">
          <h3>What you can do:</h3>
          <ul>
            <li>Draw and paint with various tools</li>
            <li>Collaborate in real-time with others</li>
            <li>Chat with other users</li>
            <li>Share your room URL to invite others</li>
          </ul>
        </div>
      </div>
    </div>
  );
};

export default NameEntry;
