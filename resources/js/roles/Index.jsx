import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter, Route, Routes, Navigate } from 'react-router-dom';

import Role from './Role';
import RoleView from './RoleView';
import RoleForm from './RoleForm';


export default function Index() {
    return (
        <BrowserRouter>
            <Routes>

                <Route path="/" element={<Role />} />
                <Route path="/roles/addrole" element={<RoleForm />} />
                <Route path="/roles/:id" element={<RoleView />} />
                <Route path="/roles/:id/edit" element={<RoleForm />} />

                <Route path="*" element={<Navigate to="/" />} />

            </Routes>
        </BrowserRouter>
    );
}

const domNode = document.getElementById('role');
const root = createRoot(domNode);

root.render(<Index />);