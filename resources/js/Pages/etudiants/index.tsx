import React from 'react';
import { InertiaLink} from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';

type Etudiant = {
  id: number;
  numero_etudiant: string;
  nom: string;
  prenom: string;
  niveau: 'L1' | 'L2' | 'L3';
};

type Props = {
  etudiants: Etudiant[];
};

const Index: React.FC<Props> = ({ etudiants }) => {
  const handleDelete = (id: number) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet étudiant ?")) {
      Inertia.delete(`/etudiants/${id}`);
    }
  };

  return (
    <div>
      <h1 className="text-2xl font-bold mb-4">Liste des étudiants</h1>
      <InertiaLink
        href="/etudiants/create"
        className="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block"
      >
        Ajouter un étudiant
      </InertiaLink>
      <table className="min-w-full table-auto border-collapse border border-gray-300">
        <thead>
          <tr>
            <th className="border p-2">Numéro Étudiant</th>
            <th className="border p-2">Nom</th>
            <th className="border p-2">Prénom</th>
            <th className="border p-2">Niveau</th>
            <th className="border p-2">Actions</th>
          </tr>
        </thead>
        <tbody>
          {etudiants.map((etudiant) => (
            <tr key={etudiant.id}>
              <td className="border p-2">{etudiant.numero_etudiant}</td>
              <td className="border p-2">{etudiant.nom}</td>
              <td className="border p-2">{etudiant.prenom}</td>
              <td className="border p-2">{etudiant.niveau}</td>
              <td className="border p-2 space-x-2">
                <InertiaLink
                  href={`/etudiants/${etudiant.id}/edit`}
                  className="bg-yellow-500 text-white px-2 py-1 rounded"
                >
                  Modifier
                </InertiaLink>
                <button
                  onClick={() => handleDelete(etudiant.id)}
                  className="bg-red-500 text-white px-2 py-1 rounded"
                >
                  Supprimer
                </button>
                <InertiaLink
                  href={`/etudiants/${etudiant.id}/notes`}
                  className="bg-green-500 text-white px-2 py-1 rounded"
                >
                  Afficher les notes
                </InertiaLink>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Index;
