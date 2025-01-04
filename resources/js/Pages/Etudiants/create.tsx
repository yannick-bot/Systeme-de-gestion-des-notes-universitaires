import React, { useState } from 'react';
import { Inertia } from '@inertiajs/inertia';

const Create: React.FC = () => {
  const [form, setForm] = useState({
    numero_etudiant: '',
    nom: '',
    prenom: '',
    niveau: 'L1',
  });

  const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    Inertia.post('/etudiants', form);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h1>Ajouter un étudiant</h1>
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

      <button type="submit">Ajouter</button>
    </form>
  );
};

export default Create;
