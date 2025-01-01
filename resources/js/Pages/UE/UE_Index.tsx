import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { InertiaLink } from '@inertiajs/inertia-react'
import { Inertia } from '@inertiajs/inertia';


interface UE {
    id: number;
    code: string,
    nom: string,
    credits_ects: number,
    semestre: number
}

interface Data {
    ues: UE[]
}

export default function Index({ ues }: Data) {

    const handleDelete = (id: number) => {
        Inertia.delete(route('UE.destroy', id));
    };

    return (
        <AuthenticatedLayout
            header={
                <div className='flex justify-between'>
                    <h2 className="text-xl font-semibold leading-tight text-gray-800">
                        UE
                    </h2>
                    <InertiaLink href={route('UE.create')}>
                        <i className="ri-add-box-fill" style={{fontSize: '30px'}}></i>
                    </InertiaLink>
                </div>
            }
        >
            <Head title="UE_List" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <table cellPadding="30" border={1} align="center">
                            <thead>
                                <tr>
                                    <th>Code UE</th>
                                    <th>Nom</th>
                                    <th>ECTS</th>
                                    <th>Semestre</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                {
                                    ues.map(ue =>
                                        (
                                            <tr key={ue.id}>
                                                <td><a href={route('EC.index', ue.id)}>{ue.code}</a></td>
                                                <td className='text-center'>{ue.nom}</td>
                                                <td className='text-center'>{ue.credits_ects}</td>
                                                <td className='text-center'>{ue.semestre}</td>
                                                <td className='flex'>
                                                    <button className="rounded-xl p-2 border-2 ml-2"><a href={route('UE.edit', ue.id)}>EDIT</a></button>
                                                   <button onClick={() => handleDelete(ue.id)} className="rounded-xl p-2 border-2 ml-2" > DELETE </button>
                                                </td>
                                            </tr>
                                        )
                                    )
                                }

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}



