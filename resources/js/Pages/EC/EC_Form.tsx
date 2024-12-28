import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import MyInput from '@/Components/MyInput';
import MyLabel from '@/Components/MyLabel';
import { useForm, } from '@inertiajs/react';
import { useEffect } from 'react';

interface UE {
    id: number;
    code: string,
    name: string,
    credits_ects: number,
    semestre: number
}

interface Data {
    ues: UE[]
}

export default function EC({ues} : Data) {

    const { data, setData, post, processing, reset, errors } = useForm({
        code: '',
        nom: '',
        coefficient: 0,
        ue_id: 0
    });

    function handleSubmit(e : React.FormEvent<HTMLFormElement>) {
        e.preventDefault();
        let optValue = document.getElementById("ueID") as HTMLSelectElement;
        setData('ue_id', Number(optValue.value));
        post(route('EC.store'), { onSuccess: () => reset() });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    EC
                </h2>
            }
        >
            <Head title="EC_Form" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <form  onSubmit={handleSubmit}>
                            <MyInput
                                type='text'
                                name='code'
                                id='codeID'
                                labelValue='CODE: '
                                inputValue={data.code}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('code', e.target.value)}
                            />
                            <MyInput
                                type='text'
                                name='nom'
                                id='nomID'
                                labelValue='NOM: '
                                inputValue={data.nom}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('nom', e.target.value)}
                            />
                            <MyInput
                                type='number'
                                name='coefficient'
                                id='coefficientID'
                                labelValue="COEFFICIENT: "
                                inputValue={data.coefficient}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('coefficient', Number(e.target.value))}
                            />
                            <MyLabel labelFor="ueID">UE: </MyLabel>
                            <select name="ue"
                                id="ueID"
                            >
                                {ues.map(ue => {
                                    return <option key={ue.id} value={ue.id}>{ue.name}</option>
                                })}
                            </select>

                            <div className='my-4'>
                                <button disabled={processing} className='rounded-xl p-2 border-2'>Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
