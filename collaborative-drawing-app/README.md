# Collaborative Drawing Room

A real-time collaborative drawing application built with React, TypeScript, and WebSocket (Socket.IO).

## Features

- **Real-time Collaboration**: Multiple users can draw on the same canvas simultaneously
- **Drawing Tools**: Pen, brush, and eraser with customizable colors and sizes
- **Chat Functionality**: Built-in chat to communicate with other users in the room
- **Room Sharing**: Share room URLs to invite others to collaborate
- **Responsive Design**: Works on desktop and mobile devices

## Tech Stack

- **Frontend**: React 19, TypeScript, React Router
- **Backend**: Node.js, Express, Socket.IO
- **Build Tool**: Vite
- **Styling**: CSS3 with responsive design

## Prerequisites

- Node.js (v18 or higher)
- npm (v9 or higher)

## Installation

1. Clone the repository
2. Navigate to the project directory:
   ```bash
   cd collaborative-drawing-app
   ```

3. Install dependencies:
   ```bash
   npm install
   ```

## Running the Application

### Development Mode

You need to run both the server and the client:

1. **Start the WebSocket server** (in one terminal):
   ```bash
   npm run server
   ```
   The server will run on `http://localhost:3001`

2. **Start the React development server** (in another terminal):
   ```bash
   npm run dev
   ```
   The application will be available at `http://localhost:5173`

### Alternative: Run both simultaneously

```bash
npm run start:all
```

## Usage

1. Open the application in your browser
2. Enter your name on the welcome screen
3. Click "Create Drawing Room" to create a new room
4. Share the room URL with others to collaborate
5. Use the drawing tools to create artwork together
6. Toggle the chat window to communicate with other users

## Building for Production

```bash
npm run build
```

The built files will be in the `dist` directory.

## Scripts

- `npm run dev` - Start the Vite development server
- `npm run build` - Build the application for production
- `npm run lint` - Run ESLint
- `npm run preview` - Preview the production build
- `npm run server` - Start the WebSocket server with hot reload
- `npm run server:build` - Build the server TypeScript files
- `npm run start:all` - Run both server and client simultaneously

## Project Structure

```
collaborative-drawing-app/
├── server/              # WebSocket server
│   ├── index.ts        # Main server file
│   └── tsconfig.json   # Server TypeScript config
├── src/
│   ├── components/     # React components
│   │   ├── Canvas.tsx  # Drawing canvas component
│   │   ├── Chat.tsx    # Chat component
│   │   └── Toolbar.tsx # Toolbar component
│   ├── pages/          # Page components
│   │   ├── NameEntry.tsx      # Welcome screen
│   │   └── DrawingRoom.tsx    # Main drawing room
│   ├── utils/          # Utility functions
│   │   └── socket.ts   # Socket.IO client setup
│   ├── App.tsx         # Main application component
│   └── main.tsx        # Application entry point
├── package.json
└── vite.config.ts
```

## License

MIT
