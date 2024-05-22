import React from 'react';
import ReactDOM from 'react-dom/client';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import UserList from './UserList';
import UserDetails from './UserDetail';

export default function Index() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={<UserList />}></Route>
                <Route path="/users/:id" element={<UserDetails />} />
                <Route path="*" element={<Navigate to="/" />} />
            </Routes>
        </BrowserRouter>
    );

}

// const domNode = document.getElementById('dropdown');
// const root = ReactDOM.createRoot(domNode);

// root.render(<Index />);