import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

type EC = {
  id: number;
  nom: string;
};

type Note = {
  ec_id: number;
  note: number;
};

type Props = {
  etudiant: {
    id: number;
    numero_etudiant: string;
    nom: string;
    prenom: string;
  };
  ecs: EC[]; // Liste des éléments constitutifs associés aux UE de l'étudiant
  notesExistantes: Note[]; // Notes existantes pour cet étudiant
};

const EditNotes: React.FC<Props> = ({ etudiant, ecs, notesExistantes }) => {
  const [notes, setNotes] = useState<Record<number, number>>(() => {
    const initialNotes: Record<number, number> = {};
    notesExistantes.forEach((note) => {
      initialNotes[note.ec_id] = note.note;
    });
    return initialNotes;
  });

  const handleChange = (ec_id: number, value: number) => {
    setNotes({ ...notes, [ec_id]: value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    // Convertir le tableau d'objets en FormData
    const formData = new FormData();
    ecs.forEach((ec) => {
      formData.append(`notes[${ec.id}][ec_id]`, ec.id.toString());
      formData.append(`notes[${ec.id}][note]`, (notes[ec.id] || 0).toString());
    });

    Inertia.post(`/etudiants/${etudiant.id}/notes`, formData);
  };


  return (
    <form onSubmit={handleSubmit}>
      <h1 className="text-2xl font-bold mb-4">Éditer les notes de {etudiant.nom} {etudiant.prenom}</h1>

      <table className="min-w-full table-auto border-collapse border border-gray-300 mb-4">
        <thead>
          <tr>
            <th className="border p-2">Élément Constitutif (EC)</th>
            <th className="border p-2">Note</th>
          </tr>
        </thead>
        <tbody>
          {ecs.map((ec) => (
            <tr key={ec.id}>
              <td className="border p-2">{ec.nom}</td>
              <td className="border p-2">
                <input
                  type="number"
                  name={`note_${ec.id}`}
                  value={notes[ec.id] || ''}
                  onChange={(e) => handleChange(ec.id, parseFloat(e.target.value))}
                  className="border p-1 rounded w-full"
                  min="0"
                  max="20"
                  step="0.1"
                />
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      <button
        type="submit"
        className="bg-blue-500 text-white px-4 py-2 rounded"
      >
        Enregistrer les notes
      </button>
    </form>
  );
};

export default EditNotes;
