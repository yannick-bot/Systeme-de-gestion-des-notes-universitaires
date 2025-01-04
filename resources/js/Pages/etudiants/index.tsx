import React from 'react';
import { InertiaLink } from '@inertiajs/inertia-react'; // Correct import

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
  return (
    <div>
      <h1>Liste des étudiants</h1>
      <InertiaLink href="/etudiants/create">Ajouter un étudiant</InertiaLink>
      <table>
        <thead>
          <tr>
            <th>Numéro Étudiant</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Niveau</th>
          </tr>
        </thead>
        <tbody>
          {etudiants.map((etudiant) => (
            <tr key={etudiant.id}>
              <td>{etudiant.numero_etudiant}</td>
              <td>{etudiant.nom}</td>
              <td>{etudiant.prenom}</td>
              <td>{etudiant.niveau}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default Index;
