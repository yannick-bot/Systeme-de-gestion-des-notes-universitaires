import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

type Props = {
  etudiant: {
    id: number;
    numero_etudiant: string;
    nom: string;
    prenom: string;
    niveau: 'L1' | 'L2' | 'L3';
  };
};

const Edit: React.FC<Props> = ({ etudiant }) => {
  const [form, setForm] = useState(etudiant);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    Inertia.put(`/etudiants/${etudiant.id}`, form);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h1>Modifier un étudiant</h1>
      <label>Numéro Étudiant:</label>
      <input name="numero_etudiant" value={form.numero_etudiant} onChange={handleChange} required />

      <label>Nom:</label>
      <input name="nom" value={form.nom} onChange={handleChange} required />

      <label>Prénom:</label>
      <input name="prenom" value={form.prenom} onChange={handleChange} required />

      <label>Niveau:</label>
      <select name="niveau" value={form.niveau} onChange={handleChange}>
        <option value="L1">L1</option>
        <option value="L2">L2</option>
        <option value="L3">L3</option>
      </select>

      <button type="submit">Mettre à jour</button>
    </form>
  );
};

export default Edit;
