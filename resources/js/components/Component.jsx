import React from 'react';
import { createRoot } from 'react-dom/client';
import ReactDOM from 'react-dom/client';
import Gallery from './Profile';
import { Profile } from './Profile';
import Count from './UserDasboard';


export default function Dashboard() {

    return (
        <Count />
    );


}

// const domNode = document.getElementById('dashboard');
// const root = createRoot(domNode);

// root.render(<Dashboard />);