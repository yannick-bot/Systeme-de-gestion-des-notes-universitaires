import React from 'react';

const ResultatsSemestre: React.FC<{ resultats: any[] }> = ({ resultats }) => {
    return (
        <div>
            <h1>Résultats par Semestre</h1>
            <table className="min-w-full border-collapse">
                <thead>
                    <tr>
                        <th className="border p-2">Nom</th>
                        <th className="border p-2">Moyenne</th>
                    </tr>
                </thead>
                <tbody>
                    {resultats.map((resultat) => (
                        <tr key={resultat.etudiant.id}>
                            <td className="border p-2">{resultat.etudiant.nom} {resultat.etudiant.prenom}</td>
                            <td className="border p-2">{resultat.moyenne}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default ResultatsSemestre;
