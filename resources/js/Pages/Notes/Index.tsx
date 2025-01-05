import React from 'react';

type Note = {
  id: number;
  ec: {
    id: number;
    nom: string;
    ue: {
      id: number;
      nom: string;
    };
  };
  note: number;
  session: string;
};

type Props = {
  etudiant: {
    id: number;
    nom: string;
    prenom: string;
  };
  notes: Note[];
};

const NotesPage: React.FC<Props> = ({ etudiant, notes }) => {
  // Calculer les moyennes par UE
  const moyennesParUE = notes.reduce((acc, note) => {
    const ueId = note.ec.ue.id;
    if (!acc[ueId]) {
      acc[ueId] = {
        nom: note.ec.ue.nom,
        total: 0,
        count: 0,
      };
    }
    acc[ueId].total += note.note;
    acc[ueId].count += 1;
    return acc;
  }, {} as Record<number, { nom: string; total: number; count: number }>);

  return (
    <div>
      <h1 className="text-2xl font-bold mb-4">
        Notes de {etudiant.nom} {etudiant.prenom}
      </h1>
      <table className="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr>
            <th className="border p-2">Nom de l'EC</th>
            <th className="border p-2">Note</th>
            <th className="border p-2">Session</th>
          </tr>
        </thead>
        <tbody>
          {notes.map((note) => (
            <tr key={note.id}>
              <td className="border p-2">{note.ec.nom}</td>
              <td className="border p-2">{note.note}</td>
              <td className="border p-2">{note.session}</td>
            </tr>
          ))}
        </tbody>
      </table>

      <div className="mt-4">
        <h2 className="text-xl font-semibold mb-2">Moyennes par UE</h2>
        <ul>
          {Object.entries(moyennesParUE).map(([ueId, ueData]) => (
            <li key={ueId} className="mb-2">
              <strong>{ueData.nom} :</strong>{' '}
              {(ueData.total / ueData.count).toFixed(2)}{' '}
              {ueData.total / ueData.count >= 10 ? (
                <span className="text-green-600 font-bold">Validée</span>
              ) : (
                <span className="text-red-600 font-bold">Non Validée</span>
              )}
            </li>
          ))}
        </ul>
      </div>
    </div>
  );
};

export default NotesPage;
