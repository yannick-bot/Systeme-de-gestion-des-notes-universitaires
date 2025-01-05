import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const CreateEtudiant = () => {
  const [values, setValues] = useState({
    numero_etudiant: '',
    nom: '',
    prenom: '',
    niveau: 'L1',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    setValues({
      ...values,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    Inertia.post('/etudiants', values);
  };

  return (
    <form onSubmit={handleSubmit}>
      <div>
        <label>Numéro Étudiant</label>
        <input type="text" name="numero_etudiant" value={values.numero_etudiant} onChange={handleChange} />
      </div>
      <div>
        <label>Nom</label>
        <input type="text" name="nom" value={values.nom} onChange={handleChange} />
      </div>
      <div>
        <label>Prénom</label>
        <input type="text" name="prenom" value={values.prenom} onChange={handleChange} />
      </div>
      <div>
        <label>Niveau</label>
        <select name="niveau" value={values.niveau} onChange={handleChange}>
          <option value="L1">L1</option>
          <option value="L2">L2</option>
          <option value="L3">L3</option>
        </select>
      </div>
      <button type="submit">Ajouter</button>

    </form>
  );
};

export default CreateEtudiant;

