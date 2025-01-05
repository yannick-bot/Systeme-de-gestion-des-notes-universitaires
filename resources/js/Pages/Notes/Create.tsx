import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

interface EC {
    id: string;
    code: string;
    nom: string;
}

interface Etudiant {
    id: string;
    nom: string;
}

const SaisieNotes: React.FC<{ ecs: EC[]; etudiants: Etudiant[] }> = ({ ecs, etudiants }) => {
    const [ecId, setEcId] = useState('');
    const [etudiantId, setEtudiantId] = useState('');
    const [note, setNote] = useState('');
    const [session, setSession] = useState('normale');

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        Inertia.post('/notes', { ec_id: ecId, etudiant_id: etudiantId, note, session });
    };

    return (
        <form onSubmit={handleSubmit} className="space-y-4">
            <div>
                <label>Élément Constitutif:</label>
                <select
                    name="ec_id"
                    value={ecId}
                    onChange={(e) => setEcId(e.target.value)}
                    required
                    className="border rounded p-2"
                >
                    <option value="">Choisir un EC</option>
                    {ecs.map((ec) => (
                        <option key={ec.id} value={ec.id}>
                            {ec.code} - {ec.nom}
                        </option>
                    ))}
                </select>
            </div>

            <div>
                <label>Étudiant :</label>
                <select name="etudiant_id" required>
                    <option value="">Sélectionnez un étudiant</option>
                    {etudiants.map((etudiant) => (
                        <option key={etudiant.id} value={etudiant.id}>{etudiant.nom}</option>
                    ))}
                </select>

            </div>

            <div>
                <label>Note:</label>
                <input
                    type="number"
                    value={note}
                    onChange={(e) => setNote(e.target.value)}
                    min="0"
                    max="20"
                    step="0.25"
                    required
                    className="border rounded p-2"
                />
            </div>

            <div>
                <label>Session:</label>
                <select
                    name="session"
                    value={session}
                    onChange={(e) => setSession(e.target.value)}
                    required
                    className="border rounded p-2"
                >
                    <option value="normale">Session Normale</option>
                    <option value="rattrapage">Rattrapage</option>
                </select>
            </div>

            <button type="submit" className="bg-blue-500 text-white py-2 px-4 rounded">
                Enregistrer
            </button>
        </form>
    );
};

export default SaisieNotes;
